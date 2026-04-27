<?php

namespace Tests\Browser;

use App\Models\User;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class UpdateTest extends DuskTestCase
{
    // use DatabaseMigrations;

    public function test_update_book_rejects_author_with_digits(): void
    {
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user): void {
            $browser->loginAs($user)
                ->visit('/books')
                ->clickLink('Tambah Buku')
                ->assertPathIs('/books/create')
                ->type('title', 'Judul Awal Dusk')
                ->type('author', 'Penulis Awal')
                ->select('category', 'Novel')
                ->type('published_year', '2023')
                ->type('stock', '3')
                ->type('summary', 'Ringkasan awal buku.')
                ->press('Simpan Buku')
                ->assertSee('Buku berhasil ditambahkan.')
                ->clickLink('Edit Buku')
                ->type('author', 'Penulis 123')
                ->press('Perbarui Buku')
                ->assertSee('Penulis tidak boleh mengandung angka.')
                ->visit('/books')
                ->assertSee('Penulis Awal')
                ->assertDontSee('Penulis 123');
        });
    }
}
