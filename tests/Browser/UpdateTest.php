<?php

namespace Tests\Browser;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class UpdateTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_update_book_shows_error_message_and_returns_to_dashboard(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create([
            'title' => 'Judul Lama Dusk',
        ]);

        $this->browse(function ($browser) use ($user, $book): void {
            $browser->loginAs($user)
                ->visit('/books/' . $book->id . '/edit')
                ->type('title', 'Judul Baru Dusk')
                ->press('Perbarui Buku')
                ->assertPathIs('/books')
                ->assertSee('Buku gagal diperbarui.');
        });
    }
}