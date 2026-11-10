<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function landing(): View
    {
        $categories = Category::withCount('books')->orderBy('name')->get();

        $featuredBooks = Book::with(['category', 'stock'])
            ->latest()
            ->take(6)
            ->get();

        $totalBooks = Book::count();
        $totalCategories = Category::count();

        return view('landing', compact('featuredBooks', 'categories', 'totalBooks', 'totalCategories'));
    }

    public function index(Request $request): View
    {
        $categories = Category::orderBy('name')->get();
        $query = Book::with(['category', 'stock']);

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('author', 'like', "%{$searchTerm}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $books = $query->latest()->paginate(12)->withQueryString();

        return view('home', compact('books', 'categories'));
    }

    public function show(Book $book): View
    {
        $book->load(['category', 'stock']);
        $relatedBooks = Book::with(['category', 'stock'])
            ->where('category_id', $book->category_id)
            ->where('id', '!=', $book->id)
            ->whereHas('stock', function ($q) {
                $q->where('quantity', '>', 0);
            })
            ->take(4)
            ->get();

        return view('user.book-detail', compact('book', 'relatedBooks'));
    }
}
