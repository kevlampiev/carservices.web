<?php

namespace Tests\Feature\Admin;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServicesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetEditServicePage()
    {
        $id = Service::query()->inRandomOrder()->first()->id;
        $response = $this->get("/admin/services/$id/edit");
        $response
            ->assertStatus(200)
            ->assertSee('Форма редактирования сервиса');
    }

    public function testGetCreateServicePage()
    {
        $response = $this->get("/admin/services/create");
        $response
            ->assertStatus(200)
            ->assertSee('Форма создания нового сервиса');
    }
}
