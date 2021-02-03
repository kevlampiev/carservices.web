<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetEditPage()
    {
        $response = $this->get('/admin/users/{user}/edit');

        $response
            ->assertStatus(200)
            ->assertSee('Редактирование заказа');
    }
}
