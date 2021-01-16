<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ClientRoot;
use Tests\DuskTestCase;

class ClientRootTest extends DuskTestCase
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
            $browser->waitForText('Записаться')
                ->assertSee('CARSERVICES.WEB');
        });
    }
}
