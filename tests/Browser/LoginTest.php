<?php

namespace Tests\Browser;

use App\Models\User;
// use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    // use DatabaseMigrations;

    public function test_user_can_login_and_see_books_page(): void
    {
        User::factory()->create([
            'name' => 'Login User',
            'email' => 'dusk.login@example.test',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function ($browser): void {
            $browser->visit('/login')
                ->type('email', 'dusk.login@example.test')
                ->type('password', 'password123')
                ->press('Login')
                ->assertPathIs('/books')
                ->assertSee('Login berhasil.')
                ->assertSee('Daftar Buku');
        });
    }
}