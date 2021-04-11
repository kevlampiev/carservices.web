<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\ClientRoot;
use Tests\Browser\Pages\Page;
use Tests\DuskTestCase;
use App\Models\User;
use Tests\Browser\Pages\OwnerPage;

class OwnerServicesTest extends DuskTestCase
{

    public $newServiceData;
    public $copyNewServiceData;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $time=date('U');
        $this->newServiceData = [
            'name'=>'test-name-'.$time,
            'city'=>'test-city-'.$time,
            'address'=>'street '.$time.' house '.$time.' office '.$time,
            'phone'=>'+7 (999) 000-0000',
            'email'=> 'email'.$time.'@test.ru',
            'telegram'=>'@'.$time,
            'skype' => $time,
            'site' => 'https://site'.$time.'.com',
            'description' => 'DUSK так здорово сочетает в себе всё лучшее,
                                что могли предложить шутеры 90-х, что возвращаться к ним ради ностальгии уже как-то
                                бессмысленно. Если вы когда-то играли в ту же Quake, обменивались дистрибутивом с
                                друзьями или ходили ради неё в гости к одноклассникам, вы наверняка помните её
                                совсем другой, чем она есть на самом деле.',
        ];
        $this->copyNewServiceData = $this->newServiceData;
    }

    /**
     *Попытка залогиниться под владельцем сервиса и перейти на страницу сервиса
     */
    public function testVisitOwnerServicesPage()
    {
        $this->browse( function(Browser $browser) {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->assertPathIs('/')
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->assertSee('Общая информация')
                ->assertSee('Расписание');
        });
    }

    public function testAddCorrectNewService()
    {
        $this->browse( function(Browser $browser) {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->click('.services-info-button-savechanges');
        });
    }

    public function testAddEmptyName()
    {
       $this->newServiceData = $this->copyNewServiceData;
       $this->newServiceData['name']='';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('Укажите название сервиса');
        });
    }

    public function testAddTooShortName()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['name']='N';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('В названии сервиса должно быть хотя бы 10 символов');
        });
    }

    public function testAddTooEmptyCity()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['city']='';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('Укажите название населенного пункта');
        });
    }

    public function testAddTooShortCity()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['city']='A';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('В названии населенного пункта должно быть хотя бы 2 символа');
        });
    }

    public function testAddEmptyAddress()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['address']='';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('Укажите адрес (улица, дом)');
        });
    }

    public function testTooShortAddress()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['address']='AAA BBB CCC';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('минимальная длина адреса - 25 символов');
        });
    }

    public function testEmptyPhone()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['phone']='';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('Укажите корректный номер телефона');
        });
    }

    public function testIncorrectPhone()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['phone']='799979';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('Укажите корректный номер телефона');
        });
    }


    public function testEmptyEmail()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['email']='';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('Укажите корректный адрес электроной почты');
        });
    }

    public function testIncorrectEmail()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['email']='incorrect@email';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('Укажите корректный адрес электроной почты');
        });
    }

    public function testIncorrectSite()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['site']='incorrect-site';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->assertSee('Укажите корректный URL сайта Вашего сервиса');
        });
    }

    public function testEmptyDescription()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['description']='';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->click('@name')
                ->assertSee('Напишите краткое описание Вашего сервиса длиной не менее 50 символов');
        });
    }


    public function testTooShortDescription()
    {
        $this->newServiceData = $this->copyNewServiceData;
        $this->newServiceData['description']='Too short description';
        $this->browse( function(Browser $browser)  {
            $browser->visit(new ClientRoot());
            Page::loginOwner($browser);
            $browser->visit(new OwnerPage())
                ->clickLink('Мои сервисы')
                ->waitForText('Список сервисов')
                ->click('.my-services-menu-add-new')
                ->fillInputs($this->newServiceData)
                ->click('@name')
                ->assertSee('Напишите краткое описание Вашего сервиса длиной не менее 50 символов');
        });
    }
}
