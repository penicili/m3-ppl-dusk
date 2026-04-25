<?php

namespace Tests\Browser;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class DeleteBookTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_delete_book_from_index(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create([
            'title' => 'Buku Hapus Dusk',
        ]);

        $this->browse(function ($browser) use ($user, $book): void {
            $browser->loginAs($user)
                ->visit('/books')
                ->assertSee('Buku Hapus Dusk')
                ->click("button[aria-label='Hapus buku']")
                ->waitForDialog()
                ->acceptDialog()
                ->assertSee('Buku berhasil dihapus.')
                ->assertDontSee('Buku Hapus Dusk');
        });
    }
}