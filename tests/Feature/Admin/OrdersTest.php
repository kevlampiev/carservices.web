<?php

namespace Tests\Feature\Admin;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrdersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetOrderEditPage()
    {
        $id = Order::query()->inRandomOrder()->first()->id;
        $response = $this->get("/admin/orders/$id/edit");
        $response
            ->assertStatus(200)
            ->assertSee('Редактирование заказа');
    }

    public function testGetCreateOrderPage()
    {
        $response = $this->get("/admin/orders/create");
        $response
            ->assertStatus(200)
            ->assertSee('Создание нового заказа');
    }
}
