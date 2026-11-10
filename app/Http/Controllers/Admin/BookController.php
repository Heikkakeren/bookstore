<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::with(['category', 'stock'])->latest()->paginate(10);

        return view('admin.books.index', compact('books'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255', 'unique:books,title'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists' => 'Kategori tidak valid.',
            'title.required' => 'Judul buku wajib diisi.',
            'title.unique' => 'Judul buku ini sudah terdaftar di sistem! Silakan gunakan judul lain.',
            'author.required' => 'Penulis wajib diisi.',
            'publisher.required' => 'Penerbit wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'cover_image.image' => 'File harus berupa gambar.',
            'cover_image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

        DB::transaction(function () use ($validated, $coverImagePath) {
            $book = Book::create([
                'category_id' => $validated['category_id'],
                'title' => $validated['title'],
                'author' => $validated['author'],
                'publisher' => $validated['publisher'],
                'price' => $validated['price'],
                'description' => $validated['description'] ?? null,
                'cover_image' => $coverImagePath,
            ]);

            // Otomatis buat baris data di tabel stocks (Relasi 1:1)
            $book->stock()->create([
                'quantity' => $validated['stock'],
            ]);
        });

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil ditambahkan beserta inventaris stok.');
    }

    public function show(Book $book): View
    {
        $book->load(['category', 'stock']);

        return view('admin.books.show', compact('book'));
    }

    public function edit(Book $book): View
    {
        $book->load('stock');
        $categories = Category::orderBy('name')->get();

        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:255', 'unique:books,title,'.$book->id],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'cover_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ], [
            'category_id.required' => 'Kategori wajib dipilih.',
            'title.required' => 'Judul buku wajib diisi.',
            'title.unique' => 'Judul buku ini sudah digunakan oleh buku lain!',
            'author.required' => 'Penulis wajib diisi.',
            'publisher.required' => 'Penerbit wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'stock.required' => 'Stok wajib diisi.',
            'stock.integer' => 'Stok harus berupa bilangan bulat.',
            'cover_image.image' => 'File harus berupa gambar.',
            'cover_image.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $coverImagePath = $book->cover_image;
        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $coverImagePath = $request->file('cover_image')->store('covers', 'public');
        }

        DB::transaction(function () use ($book, $validated, $coverImagePath) {
            $book->update([
                'category_id' => $validated['category_id'],
                'title' => $validated['title'],
                'author' => $validated['author'],
                'publisher' => $validated['publisher'],
                'price' => $validated['price'],
                'description' => $validated['description'] ?? null,
                'cover_image' => $coverImagePath,
            ]);

            // Perbarui kuantitas di tabel stocks
            $book->stock()->updateOrCreate(
                ['book_id' => $book->id],
                ['quantity' => $validated['stock']]
            );
        });

        return redirect()->route('admin.books.index')->with('success', 'Buku dan inventaris stok berhasil diperbarui.');
    }

    public function destroy(Book $book): RedirectResponse
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Buku berhasil dihapus.');
    }
}
