<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ClientRoot;
use Tests\DuskTestCase;
use Tests\Browser\Pages\Page;

class RegisterTest extends DuskTestCase
{
    /**
     * Регистрируем произвольного пользователя
     *
     * @return void
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(new ClientRoot());
            Page::logginOut($browser);
            $browser->assertSee('CARSERVICES.WEB');
        });
    }
}
