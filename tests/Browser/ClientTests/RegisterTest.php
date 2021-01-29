<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ClientRoot;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Page;
use App\Models\User;

class RegisterTest extends DuskTestCase
{
    /**
     * Регистрируем произвольного пользователя с ролью 'user'
     *
     * @return void
     */
    public function testSuccessRegister()
    {

        $this->browse(function (Browser $browser) {
            $email = 'test' . date('U') . '@test.ru';
            $browser->visit(new ClientRoot());
            Page::register($browser,
                'Тестовый юзер',
                $email,
                '12345678',
                '12345678');

            $browser->waitForText('Выйти')
                ->assertSee($email)
                ->assertDontSee('Раздел администратора')
                ->assertDontSee('Мои сервисы');
        });
    }

    /**
     * Попытка регистрации пользователя с уже имеющимся e-mail
     *
     * @return void
     */
    public function testAlreadyRegisteredUser()
    {
        $this->browse(function (Browser $browser) {
            $email = User::query()->first()->email;
            $browser->visit(new ClientRoot());
            Page::register($browser,
                'Уже существующий юзер',
                $email,
                '12345678',
                '12345678');

            $browser->pause(5000)
                ->assertDialogOpened('Пользователь с таким адресом электронной почты уже зарегистрирован в системе')
                ->acceptDialog()
                ->assertSee('Зарегистрироваться');
        });
    }


    /**
     * Попытка регистрации пользователя без имени
     *
     * @return void
     */
    public function testUserNameAbsent()
    {
        $this->browse(function (Browser $browser) {
            $email = 'test' . date('U') . '@test.ru';
            $browser->visit(new ClientRoot());
            Page::register($browser,
                '',
                $email,
                '12345678',
                '12345678');

            $browser->pause(1000)
                ->assertSee('Для регистрации необходимо имя')
                ->assertSee('Зарегистрироваться')
                ->assertButtonDisabled('#ok-button');
        });
    }

    /**
     * Попытка регистрации пользователя со слишком коротким имененем
     *
     * @return void
     */
    public function testUserNameTooShort()
    {
        $this->browse(function (Browser $browser) {
            $email = 'test' . date('U') . '@test.ru';
            $browser->visit(new ClientRoot());
            Page::register($browser,
                'a',
                $email,
                '12345678',
                '12345678');

            $browser->pause(1000)
                ->assertSee('Минимальное количество символов в имени должно быть 2')
                ->assertSee('Зарегистрироваться')
                ->assertButtonDisabled('#ok-button');
        });
    }

    /**
     * Попытка регистрации пользователя без e-mail
     *
     * @return void
     */
    public function testUserEmailAbsent()
    {
        $this->browse(function (Browser $browser) {
            $email = '';
            $browser->visit(new ClientRoot());
            Page::register($browser,
                'Пользователь без email',
                $email,
                '12345678',
                '12345678');

            $browser->pause(1000)
                ->assertSee('адрес электронной почты явялется обязательным для регистрации')
                ->assertSee('Зарегистрироваться')
                ->assertButtonDisabled('#ok-button');
        });
    }

    /**
     * Попытка регистрации пользователя с невалидируемым email
     *
     * @return void
     */
    public function testInvalidEmail()
    {
        $this->browse(function (Browser $browser) {
            $email = 'test' . date('U') . '@';
            $browser->visit(new ClientRoot());
            Page::register($browser,
                'Пользователь с кривым email',
                $email,
                '12345678',
                '12345678');

            $browser->pause(1000)
                ->assertSee('Введенное значение не является адресом электронной почты')
                ->assertSee('Зарегистрироваться')
                ->assertButtonDisabled('#ok-button');
        });
    }

    /**
     * Попытка регистрации пользователя без пароля
     *
     * @return void
     */
    public function testPasswordAbsent()
    {
        $this->browse(function (Browser $browser) {
            $email = 'test' . date('U') . '@test.ru';
            $browser->visit(new ClientRoot());
            Page::register($browser,
                'Пользователь без пароля',
                $email,
                '',
                '');

            $browser->pause(1000)
                ->assertSee('задайте пароль длиной не менее 8 символов')
                ->assertSee('Зарегистрироваться')
                ->assertButtonDisabled('#ok-button');
        });
    }

    /**
     * Попытка регистрации пользователя со слишком коротким паролем
     *
     * @return void
     */
    public function testPasswordTooShort()
    {
        $this->browse(function (Browser $browser) {
            $email = 'test' . date('U') . '@test.ru';
            $browser->visit(new ClientRoot());
            Page::register($browser,
                'Пользователь без пароля',
                $email,
                '12345',
                '12345');

            $browser->pause(1000)
                ->assertSee('длина пароля должна быть не менее 8 символов')
                ->assertSee('Зарегистрироваться')
                ->assertButtonDisabled('#ok-button');
        });
    }

    /**
     * Попытка регистрации пользователя когда введенные пароли не совпадают
     *
     * @return void
     */
    public function testPasswordsDontMatch()
    {
        $this->browse(function (Browser $browser) {
            $email = 'test' . date('U') . '@test.ru';
            $browser->visit(new ClientRoot());
            Page::register($browser,
                'Пользователь без пароля',
                $email,
                '123456789',
                '12345345678');

            $browser->pause(1000)
                ->assertSee('введенные пароли не совпадают')
                ->assertSee('Зарегистрироваться')
                ->assertButtonDisabled('#ok-button');
        });
    }

}
