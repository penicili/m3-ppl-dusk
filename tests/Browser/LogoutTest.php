<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\DuskTestCase;

class LogoutTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_user_can_logout_after_login(): void
    {
        User::factory()->create([
            'name' => 'Logout User',
            'email' => 'dusk.logout@example.test',
            'password' => bcrypt('password123'),
        ]);

        $this->browse(function ($browser): void {
            $browser->visit('/login')
                ->type('email', 'dusk.logout@example.test')
                ->type('password', 'password123')
                ->press('Login')
                ->assertPathIs('/books')
                ->click('.user-icon-btn')
                ->press('Logout')
                ->assertPathIs('/login')
                ->assertSee('Logout berhasil.');
        });
    }
}