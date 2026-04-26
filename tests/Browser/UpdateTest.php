<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class UpdateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_update_book_shows_error_message_and_returns_to_dashboard(): void
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user): void {
            $browser->loginAs($user)
                ->visit('/books')
                ->clickLink('Tambah Buku')
                ->assertPathIs('/books/create')
                ->type('title', 'Judul Lama Dusk')
                ->type('author', 'Penulis Lama')
                ->select('category', 'Novel')
                ->type('published_year', '2023')
                ->type('stock', '3')
                ->type('summary', 'Ringkasan awal buku.')
                ->press('Simpan Buku')
                ->assertSee('Buku berhasil ditambahkan.')
                ->clickLink('Edit Buku')
                ->type('title', 'Judul Baru Dusk')
                ->press('Perbarui Buku')
                ->assertPathIs('/books')
                ->assertSee('Buku gagal diperbarui.')
                ->assertSee('Judul Lama Dusk')
                ->assertDontSee('Judul Baru Dusk');
        });
    }
}
