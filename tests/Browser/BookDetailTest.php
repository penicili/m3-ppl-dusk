<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class BookDetailTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_open_book_detail_page(): void
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user): void {
            $browser->loginAs($user)
                ->visit('/books')
                ->clickLink('Tambah Buku')
                ->assertPathIs('/books/create')
                ->type('title', 'Buku Detail Dusk')
                ->type('author', 'Penulis Detail')
                ->select('category', 'Novel')
                ->type('published_year', '2024')
                ->type('stock', '5')
                ->type('summary', 'Ringkasan buku untuk pengujian detail.')
                ->press('Simpan Buku')
                ->assertSee('Buku berhasil ditambahkan.')
                ->clickLink('Kembali')
                ->assertPathIs('/books')
                ->assertSee('Buku Detail Dusk')
                ->clickLink('Detail')
                ->assertSee('Buku Detail Dusk')
                ->assertSee('Penulis Detail');
        });
    }
}
