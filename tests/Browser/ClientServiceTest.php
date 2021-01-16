<?php

namespace Tests\Browser;

use App\Models\Service;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ClientRoot;
use Tests\DuskTestCase;

class ClientServiceTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $id = Service::query()->inRandomOrder()->first()->id;
            $browser->visit('/service/' . $id);
            $browser->waitFor('.menu-ul')
                ->assertSee('Виды услуг')
                ->assertSee('Описание')
                ->assertSee('Дата и время');
        });
    }
}
