<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class DeleteBookTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_delete_book_from_index(): void
    {
        User::factory()->create([
            'email' => 'dusk.delete@example.test',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function ($browser): void {
            $browser->visit('/login')
                ->type('email', 'dusk.delete@example.test')
                ->type('password', 'password123')
                ->press('Login')
                ->assertPathIs('/books')
                ->clickLink('Tambah Buku')
                ->assertPathIs('/books/create')
                ->type('title', 'Buku Hapus Dusk')
                ->type('author', 'Penulis Hapus')
                ->select('category', 'Novel')
                ->type('published_year', '2022')
                ->type('stock', '2')
                ->type('summary', 'Buku ini akan dihapus.')
                ->press('Simpan Buku')
                ->assertSee('Buku berhasil ditambahkan.')
                ->clickLink('Kembali')
                ->assertPathIs('/books')
                ->assertSee('Buku Hapus Dusk')
                ->click("button[aria-label='Hapus buku']")
                ->waitForDialog()
                ->acceptDialog()
                ->assertSee('Buku berhasil dihapus.')
                ->assertDontSee('Buku Hapus Dusk');
        });
    }
}
