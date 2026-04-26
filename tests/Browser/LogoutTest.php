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
        $user = User::factory()->create();

        $this->browse(function ($browser) use ($user): void {
            $browser->loginAs($user)
                ->visit('/books')
                ->click('.user-icon-btn')
                ->press('Logout')
                ->assertPathIs('/login')
                ->assertSee('Logout berhasil.');
        });
    }
}
