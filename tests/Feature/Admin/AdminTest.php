<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetMainPage()
    {
        $response = $this->get('/admin');

        $response
            ->assertSeeText('Выберите таблицу для редактирования')
            ->assertStatus(200);
    }

    public function testGetUsersPage()
    {
        $response = $this->get('/admin/users');
        $response
            ->assertSee('Добавить нового пользователя')
            ->assertStatus(200);
    }

    public function testGetServicesPage()
    {
        $response = $this->get('/admin/services');
        $response
            ->assertSee('Добавить новый сервис')
            ->assertStatus(200);
    }

    public function testGetSchedulesPage()
    {
        $response = $this->get('/admin/schedules');
        $response
            ->assertSee('Добавить новую запись')
            ->assertStatus(200);
    }

    public function testGetOrdersPage()
    {
        $response = $this->get('/admin/orders');
        $response
            ->assertSee('Добавить новый заказ')
            ->assertStatus(200);
    }
}
