<?php

namespace Tests\Browser\Pages;

use Facebook\WebDriver\Exception\TimeOutException;
use Laravel\Dusk\Browser;
use Laravel\Dusk\Page as BasePage;
use phpDocumentor\Reflection\Types\Boolean;
use App\Models\User;

class OwnerPage extends Page
{
    /**
     *Return page url
     *
     *@return string
     */
    public function url():string
    {
        return '/owner';
    }


    /**
     *Common asserts
     *
     * @param Browser $browser
     * @return void
     * @throws TimeOutException
     */
    public function assert(Browser $browser)
    {
        $browser->assertPathIs('/owner')
            ->waitForText('Список сервисов')
            ->assertSee('Общая информация')
            ->assertSee('Расписание')
            ->assertSee('Наименование')
            ->assertSee('Город')
            ->assertSee('Улица, дом/строение');
    }

    /**
     * Get the global element shortcuts for the site.
     *
     * @return array
     */
    public function elements(): array
    {
        return [
            '@name' => '#service-name',
            '@city'=>'#service-city',
            '@address'=>'#service-address',
            '@phone'=>'#service-phone',
            '@email'=>'#service-email',
            '@telegram'=>'#service-telegram',
            '@skype' => '#service-skype',
            '@site' => '#service-site',
            '@description' => '#services-info-field-textarea',
        ];
    }

    public function fillInputs(Browser $browser, $data)
    {
        $browser->type('@name',$data['name'])
        ->type('@city', $data['city'])
        ->type('@address',$data['address'])
        ->type('@phone', $data['phone'])
        ->type('@email', $data['email'])
        ->type('@telegram', $data['telegram'])
        ->type('@site', $data['site'])
        ->type('@description', $data['description']);
    }

}
