<?php

namespace Tests\Browser;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class BookDetailTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_open_book_detail_page(): void
    {
        $user = User::factory()->create();
        $book = Book::factory()->create([
            'title' => 'Buku Detail Dusk',
            'author' => 'Penulis Detail',
        ]);

        $this->browse(function ($browser) use ($user, $book): void {
            $browser->loginAs($user)
                ->visit('/books/' . $book->id)
                ->assertSee('Buku Detail Dusk')
                ->assertSee('Penulis Detail');
        });
    }
}