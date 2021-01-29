<?php

namespace Tests\Browser\Pages;

use Facebook\WebDriver\Exception\TimeOutException;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;
use phpDocumentor\Reflection\Types\Boolean;

abstract class Page extends BasePage
{
    /**
     * Get the global element shortcuts for the site.
     *
     * @return array
     */
    public static function siteElements()
    {
        return [
            '@logout' => '#logout-link',
            '@login' => '#login-link',
            '@register' => '#register-link'
        ];
    }

    public static function clearLocalStorage(Browser $browser)
    {
        $browser->script("localStorage.removeItem('token')");
    }

    public static function isLogin(Browser $browser): \Facebook\WebDriver\Remote\RemoteWebElement
    {
        return $browser->element('@logout');
    }

    /**
     *Вспомогательная функция для выхода из профиля (logout)
     *@return void
     */
    public static function logginOut(Browser $browser)
    {
        $browser->pause(5000);
        if ($browser->element('@logout')) {
            try {
                $browser->click('@logout')
                    ->waitForText('Зарегистрироваться');
            } catch (TimeOutException $e) {
                dump($e);
            }
        } else {

            $token = $browser->script("return localStorage.getItem('token')")[0];
            if ($token) {
                dump('already not in system but token ' . $token . ' exists ....');
            }
        }
    }

    /**
     *Вспомогательная функция для заполнения формы авторизации
     *@return void
     */
    public static function login(Browser $browser, string $email, string $password, bool $rememberMe)
    {

        static::logginOut($browser);
        try {
            $browser->click('#login-link')
                ->waitForText('Ok')
                ->type('#company-entry-row-input-email', $email)
                ->type('#company-entry-row-input-password', $password);
            if (!$rememberMe) {
                $browser->click('#rememberMe-label');
            }
            $browser->click('#Ok-button')
                ->waitForText('Выйти');
        } catch (TimeOutException $e) {
            dump($e);
        }
    }

    /**
     *Вспомогательная функция для заполнения формы регистрации
     *@return void
     */
    public static function register(Browser $browser,
                                    string $name,
                                    string $email,
                                    string $password,
                                    string $passwordAgain) {
        static::logginOut($browser);
        try {
            $browser
                ->waitForText('Зарегистрироваться')
                ->click('#register-link')
                ->waitForText('ЗАРЕГИСТРИРОВАТЬСЯ')
                ->type('#company-entry-row-input-name',$name)
                ->type('#company-entry-row-input-email',$email)
                ->type('#company-entry-row-input-password',$password)
                ->type('#company-entry-row-input-repassword',$passwordAgain)
                ->click('#ok-button');

        } catch (TimeOutException $error) {
            dump($error);
        }

    }
}
