<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = Cart::with(['book.category', 'book.stock'])
            ->where('user_id', auth()->id())
            ->get();

        $totalPrice = $cartItems->sum(fn (Cart $item) => $item->quantity * $item->book->price);

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    public function add(Request $request, Book $book): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $availableStock = $book->stock?->quantity ?? 0;
        if ($availableStock <= 0) {
            return back()->with('error', "Maaf, stok buku '{$book->title}' sudah habis terjual dan tidak dapat dipesan lagi!");
        }
        if ($availableStock < $validated['quantity']) {
            return back()->with('error', "Stok buku '{$book->title}' tidak mencukupi. Sisa stok tersedia: {$availableStock} pcs.");
        }

        $cartItem = Cart::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $validated['quantity'];
            if ($newQuantity > $availableStock) {
                return back()->with('error', 'Total qty melebihi stok yang tersedia ('.$availableStock.').');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'book_id' => $book->id,
                'quantity' => $validated['quantity'],
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Buku berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Cart $cart): RedirectResponse
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak. Keranjang ini bukan milik Anda.');
        }

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $availableStock = $cart->book->stock?->quantity ?? 0;
        if ($availableStock <= 0) {
            return back()->with('error', "Maaf, stok buku '{$cart->book->title}' sudah habis terjual!");
        }
        if ($availableStock < $validated['quantity']) {
            return back()->with('error', "Stok buku '{$cart->book->title}' tidak mencukupi. Sisa stok tersedia: {$availableStock} pcs.");
        }

        $cart->update(['quantity' => $validated['quantity']]);

        return redirect()->route('cart.index')->with('success', 'Jumlah buku berhasil diperbarui.');
    }

    public function destroy(Cart $cart): RedirectResponse
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak. Keranjang ini bukan milik Anda.');
        }

        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Buku berhasil dihapus dari keranjang.');
    }
}
