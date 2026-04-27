<?php

namespace Tests\Browser;

use App\Models\User;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class CreateBookTest extends DuskTestCase
{
    // use DatabaseMigrations;

    public function test_user_can_create_book_from_form(): void
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user): void {
            $browser->loginAs($user)
                ->visit('/books')
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
