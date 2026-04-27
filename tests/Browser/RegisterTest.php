<?php

namespace Tests\Browser;

// use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class RegisterTest extends DuskTestCase
{
    // use DatabaseMigrations;

    public function test_user_can_register_and_redirect_to_books_index(): void
    {
        $this->browse(function ($browser): void {
            $browser->visit('/register')
                ->type('name', 'Dusk User')
                ->type('email', 'dusk.register@example.test')
                ->type('password', 'password123')
                ->type('password_confirmation', 'password123')
                ->press('Register')
                ->assertPathIs('/books')
                ->assertSee('Registrasi berhasil.')
                ->assertSee('Daftar Buku');
        });
    }
}