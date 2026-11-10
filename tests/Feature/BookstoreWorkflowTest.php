<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookstoreWorkflowTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected User $user;

    protected Book $book;

    protected Stock $stock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@test.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        $this->user = User::create([
            'name' => 'User Test',
            'email' => 'user@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
            'address' => 'Jl. Pengujian No. 10',
        ]);

        $category = Category::create([
            'name' => 'Teknologi',
            'slug' => 'teknologi',
        ]);

        $this->book = Book::create([
            'category_id' => $category->id,
            'title' => 'Mastering Laravel',
            'author' => 'Taylor Otwell',
            'publisher' => 'Laravel LLC',
            'price' => 150000,
            'description' => 'Buku Laravel Terbaik',
        ]);

        $this->stock = Stock::create([
            'book_id' => $this->book->id,
            'quantity' => 10,
        ]);
    }

    public function test_public_user_can_view_catalog(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('Mastering Laravel');
    }

    public function test_guest_is_redirected_to_login_when_accessing_admin_dashboard(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('login'));
    }

    public function test_regular_user_cannot_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->user)->get(route('admin.dashboard'));
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
    }

    public function test_user_can_add_book_to_cart_and_update_it(): void
    {
        $response = $this->actingAs($this->user)->post(route('cart.add', $this->book), [
            'quantity' => 2,
        ]);

        $response->assertRedirect(route('cart.index'));
        $this->assertDatabaseHas('carts', [
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'quantity' => 2,
        ]);
    }

    public function test_user_cannot_add_more_than_available_stock(): void
    {
        $response = $this->actingAs($this->user)->post(route('cart.add', $this->book), [
            'quantity' => 99, // stock is 10
        ]);

        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('carts', [
            'user_id' => $this->user->id,
            'quantity' => 99,
        ]);
    }

    public function test_checkout_reduces_stock_in_stocks_table_and_clears_cart(): void
    {
        Cart::create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'quantity' => 3,
        ]);

        $response = $this->actingAs($this->user)->post(route('checkout.process'), [
            'shipping_address' => 'Jl. Uji Kirim No. 123, Bandung',
            'payment_method' => 'qris',
        ]);

        $response->assertRedirect(route('orders.history'));

        // Keranjang kosong
        $this->assertDatabaseMissing('carts', [
            'user_id' => $this->user->id,
        ]);

        // Stok di tabel stocks berkurang dari 10 menjadi 7
        $this->assertEquals(7, $this->stock->fresh()->quantity);

        // Order terbentuk
        $this->assertDatabaseHas('orders', [
            'user_id' => $this->user->id,
            'payment_method' => 'qris',
            'total_price' => 450000,
        ]);
    }

    public function test_checkout_rejects_cod_and_accepts_gopay_and_transfer(): void
    {
        Cart::create([
            'user_id' => $this->user->id,
            'book_id' => $this->book->id,
            'quantity' => 1,
        ]);

        // COD ditolak
        $responseCod = $this->actingAs($this->user)->post(route('checkout.process'), [
            'shipping_address' => 'Jl. Uji Kirim No. 123, Bandung',
            'payment_method' => 'cod',
        ]);
        $responseCod->assertSessionHasErrors('payment_method');

        // GoPay diterima
        $responseGopay = $this->actingAs($this->user)->post(route('checkout.process'), [
            'shipping_address' => 'Jl. Uji Kirim No. 123, Bandung',
            'payment_method' => 'gopay',
        ]);
        $responseGopay->assertRedirect(route('orders.history'));
    }

    public function test_user_cannot_modify_or_delete_other_users_cart(): void
    {
        $otherUser = User::create([
            'name' => 'Other User',
            'email' => 'other@test.com',
            'password' => bcrypt('password123'),
            'role' => 'user',
        ]);

        $otherCart = Cart::create([
            'user_id' => $otherUser->id,
            'book_id' => $this->book->id,
            'quantity' => 1,
        ]);

        // User coba menghapus cart milik otherUser
        $response = $this->actingAs($this->user)->delete(route('cart.destroy', $otherCart));
        $response->assertStatus(403);
    }

    public function test_auth_pages_render_password_visibility_toggles(): void
    {
        $loginResponse = $this->get(route('login'));
        $loginResponse->assertStatus(200);
        $loginResponse->assertSee('toggle-password');
        $loginResponse->assertSee('bi-eye');

        $registerResponse = $this->get(route('register'));
        $registerResponse->assertStatus(200);
        $registerResponse->assertSee('toggle-password');
        $registerResponse->assertSee('regPasswordConfirm');
    }

    public function test_guest_and_user_can_send_contact_message(): void
    {
        $payload = [
            'name' => 'Budi Santoso',
            'email' => 'budi@test.com',
            'message' => 'Halo Admin, apakah buku Laravel ready stock?',
        ];

        $response = $this->post(route('contact.store'), $payload);
        $response->assertRedirect(route('user.contact'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('contacts', [
            'name' => 'Budi Santoso',
            'email' => 'budi@test.com',
        ]);
    }

    public function test_admin_cannot_send_contact_message_to_themselves(): void
    {
        // Admin membuka halaman kontak
        $viewResponse = $this->actingAs($this->admin)->get(route('contact'));
        $viewResponse->assertStatus(200);
        $viewResponse->assertSee('Akses Administrator Terdeteksi');

        // Admin mencoba submit formulir kontak
        $postResponse = $this->actingAs($this->admin)->post(route('contact.store'), [
            'name' => 'Admin Self',
            'email' => 'admin@test.com',
            'message' => 'Pesan dari admin untuk admin sendiri',
        ]);

        $postResponse->assertRedirect(route('admin.messages.index'));
        $postResponse->assertSessionHas('error');

        // Pastikan tidak ada data yang masuk ke database
        $this->assertDatabaseMissing('contacts', [
            'name' => 'Admin Self',
        ]);
    }
}
