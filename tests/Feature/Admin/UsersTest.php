<?php

namespace Tests\Feature\Admin;

use App\Models\User;
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
        $id = User::query()->inRandomOrder()->first()->id;
        $response = $this->get("/admin/users/$id/edit");
        $response
            ->assertStatus(200)
            ->assertSee('Редактирование данных пользователя');
    }

    public function testGetCreateUserPage()
    {
        $response = $this->get("/admin/users/create");
        $response
            ->assertStatus(200)
            ->assertSee('Создание нового пользователя');
    }
}
