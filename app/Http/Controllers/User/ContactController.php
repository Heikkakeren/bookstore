<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactController extends Controller
{
    public function index(): View
    {
        return view('contact');
    }

    public function store(Request $request): RedirectResponse
    {
        // Cegah Admin mengirim pesan ke diri sendiri
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.messages.index')
                ->with('error', 'Sebagai Administrator, Anda tidak dapat mengirim pesan ke diri sendiri. Silakan kelola pesan pengunjung di sini.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:2000'],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan wajib diisi.',
            'message.min' => 'Pesan minimal 10 karakter.',
        ]);

        Contact::create([
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        return redirect()->route('user.contact')->with('success', 'Pesan Anda berhasil terkirim! Kami akan menghubungi Anda segera.');
    }
}
