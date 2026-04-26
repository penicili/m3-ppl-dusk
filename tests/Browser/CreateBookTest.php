<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class CreateBookTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_create_book_from_form(): void
    {
        User::factory()->create([
            'email' => 'dusk.create@example.test',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function ($browser): void {
            $browser->visit('/login')
                ->type('email', 'dusk.create@example.test')
                ->type('password', 'password123')
                ->press('Login')
                ->assertPathIs('/books')
                ->clickLink('Tambah Buku')
                ->assertPathIs('/books/create')
                ->type('title', 'Buku Dusk Baru')
                ->type('author', 'Penulis Dusk')
                ->select('category', 'Novel')
                ->type('published_year', '2024')
                ->type('stock', '7')
                ->type('summary', 'Ringkasan buku untuk pengujian Dusk.')
                ->press('Simpan Buku')
                ->assertSee('Buku berhasil ditambahkan.')
                ->assertSee('Buku Dusk Baru');
        });
    }
}
