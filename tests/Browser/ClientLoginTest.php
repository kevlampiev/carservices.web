<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ClientRoot;
use Tests\Browser\Pages\Page;
use Tests\DuskTestCase;
use App\Models\User;

class ClientLoginTest extends DuskTestCase
{
    /**
     *
     *Возвращет случайный тестовый e-mail из базы для роли
     * @return string
     */
    private function getTestUserEmail(string $role): string
    {
        return User::query()
            ->select('email')
            ->where('role', $role)
            ->where('email', 'like', 'test%')
            ->inRandomOrder()
            ->first()
            ->email;
    }


    /**
     *Тестирование нажание кнопки "Выход" из приложения
     * @return void
     */
    public function testLogout()
    {
        try {
            $this->browse(function (Browser $browser) {
                $browser->visit(new ClientRoot());
                Page::logginOut($browser);
                $browser->assertPathIs('/')
                    ->assertSee('Войти')
                    ->assertSee('Зарегистрироваться')
                    ->assertSee('CARSERVICES.WEB')
                    ->assertDontSee('Выйти')
                    ->assertDontSee('Мои сервисы')
                    ->assertDontSee('Раздел администратора');
            });
        } catch (\Throwable $e) {
            dump($e);
        }
    }

    /**
     *Тестирование входа в качестве Администратора
     * @return void
     */
    public function testLoginAsAdmin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new ClientRoot());
            Page::login($browser, 'admin@admin.ru', '12345678', false);
            $browser->assertSee('Выйти')
                ->assertDontSee('Зарегистрироваться')
                ->assertDontSee('Войти')
                ->assertSee('CARSERVICES.WEB')
                ->assertSee('admin@admin.ru')
                ->assertDontSee('Мои сервиы');
            //TODO добавить, что он еще видит "Раздел администратора"
        });
    }

    /**
     *Тестирование входа в качестве простого юзера
     * @return void
     */
    public function testLoginAsClient()
    {
        $this->browse(function (Browser $browser) {
            $email = $this->getTestUserEmail('user');
            $browser->visit(new ClientRoot());
            Page::login($browser, $email, '12345678', false);
            $browser->assertSee('Выйти')
                ->assertDontSee('Зарегистрироваться')
                ->assertDontSee('Войти')
                ->assertSee('CARSERVICES.WEB')
                ->assertSee($email)
                ->assertDontSee('Раздел администратора')
                ->assertDontSee('Мои сервисы');
        });
    }

    /**
     *Тестирование входа в качестве Владельца сервиса
     * @return void
     */
    public function testLoginAsIOwner()
    {
        $this->browse(function (Browser $browser) {
            $email = $this->getTestUserEmail('owner');
            $browser->visit(new ClientRoot());
            Page::login($browser, $email, '12345678', false);
            $browser->assertSee('Выйти')
                ->assertDontSee('Зарегистрироваться')
                ->assertDontSee('Войти')
                ->assertSee($email)
                ->assertDontSee('Раздел администратора');
            //TODO добавить, что он еще ВИДИТ раздел "Мои сервисы"
        });
    }

    /**
     *Тестирование входа с неправильным e-mail
     * @return void
     */
    public function testLoginIncorrectEmail()
    {
        $this->browse(function (Browser $browser) {
            $email = $this->getTestUserEmail('user');
            $browser->visit(new ClientRoot());
            Page::logginOut($browser);
            $browser->click('#login-link')
                ->waitForText('Ok')
                ->type('#company-entry-row-input-password', '12345678')
                ->type('#company-entry-row-input-email', 'incorrect' . $email)
                ->click('#Ok-button')
                ->pause(10000)
                ->assertDialogOpened('Данный e-mail не зарегистрирован в системе')
                ->assertSee('Зарегистрироваться');
        });
    }


}
