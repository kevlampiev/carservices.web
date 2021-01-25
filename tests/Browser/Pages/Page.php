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
//            '@login'=>'#login-link',
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

    public static function logginOut(Browser $browser)
    {
        if ($browser->element('@logout')) {
            try {
                $browser->click('@logout')
                    ->waitForText('Зарегистрироваться');
            } catch (TimeOutException $e) {
                dump($e);
            }
        } else {

            $token=$browser->script("return localStorage.getItem('token')")[0];
            if ($token) {
            dump('already not in system but token '.$token.' exists ....');}
        }
    }

    public static function login(Browser $browser, string $email, string $password, bool $rememberMe)
    {

        static::logginOut($browser);
        try {
            $browser->click('#login-link')
                ->waitForText('Ok')
                ->type('#company-entry-row-input-email', $email)
                ->type('#company-entry-row-input-password', $password);
//                    if ($rememberMe) {
//                        $browser->check('#rememberMe');
//                    } else {
//                        $browser->uncheck('#rememberMe');
//                    }

            $browser->click('#Ok-button')
                ->waitForText('Выйти');
        } catch (TimeOutException $e) {
            dump($e);
        }
    }
}
