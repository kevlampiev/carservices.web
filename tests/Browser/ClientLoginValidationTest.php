<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ClientRoot;
use Tests\Browser\Pages\Page;
use Tests\DuskTestCase;
use App\Models\User;

class ClientLoginValidationTest extends DuskTestCase
{
    /**
     * Проверяет что будет, если забыть ввести email при login
     * @return void
     */
    public function testLoginEmailAbsent()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new ClientRoot());
            Page::logginOut($browser);
            $browser->click('#login-link')
                ->waitForText('Ok')
                ->type('#company-entry-row-input-email', '')
                ->type('#company-entry-row-input-password', '123456789')
                ->assertSee('адрес электронной почты явялется обязательным для регистрации')
                ->assertButtonDisabled('#Ok-button');
        });
    }

    /**
     * Проверяет что будет, если ввести неверный email при login
     * @return void
     */
    public function testLoginEmailFormatIncorrect()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new ClientRoot());
            Page::logginOut($browser);
            $browser->click('#login-link')
                ->waitForText('Ok')
                ->type('#company-entry-row-input-email', '111')
                ->type('#company-entry-row-input-password', '123456789')
                ->assertSee('введенное значение не является адресом электронной почты')
                ->assertButtonDisabled('#Ok-button');
        });
    }

    /**
     * Проверяет что будет, если ввести неверный email при login
     * @return void
     */
    public function testLoginPasswordAbsent()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new ClientRoot());
            Page::logginOut($browser);
            $browser->click('#login-link')
                ->waitForText('Ok')
                ->type('#company-entry-row-input-password', '')
                ->type('#company-entry-row-input-email', 'admin@admin.ru')
                ->assertSee('для входа требуется пароль')
                ->assertButtonDisabled('#Ok-button');
        });
    }

    /**
     * Проверяет что будет, если ввести пароль короче 8 символов при login
     * @return void
     */
    public function testLoginPasswordTooShot()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new ClientRoot());
            Page::logginOut($browser);
            $browser->click('#login-link')
                ->waitForText('Ok')
                ->type('#company-entry-row-input-password', '12345')
                ->type('#company-entry-row-input-email', 'admin@admin.ru')
                ->assertSee('длина пароля не может быть менее 8 символов')
                ->assertButtonDisabled('#Ok-button');
        });
    }


}
