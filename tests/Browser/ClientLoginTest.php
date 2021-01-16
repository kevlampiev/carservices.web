<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ClientRoot;
use Tests\DuskTestCase;

class ClientLoginTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new ClientRoot());
            $token = $browser->script("return localStorage.getItem('token')")[0];
            $browser->waitForText('Записаться')
                ->assertSee('CARSERVICES.WEB');
            dump('Token:' . $token);
            if ($token) {
                $browser->assertSee('Выйти')
                    ->click('#logout-link"')
                    ->waitForText('Войти')
                    ->assertPathIs('/')
                    ->assertSee('Зарегистрироваться');


            } else {
                $browser->assertSee('Войти')
                    ->assertSee('Зарегистрироваться')
                    ->click('#login-link')
                    ->waitForText('Ok')
                    ->type('#company-entry-row-input-email', 'admin@admin.ru')
                    ->type('#company-entry-row-input-password', '12345678')
                    ->click('#company-entry-form-button')
                    ->waitForText('Выйти')
                    ->assertSee('admin@admin.ru');
            }
        });
    }
}
