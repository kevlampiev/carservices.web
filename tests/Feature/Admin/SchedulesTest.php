<?php

namespace Tests\Feature\Admin;

use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SchedulesTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetScheduleEditPage()
    {
        $id = Schedule::query()->inRandomOrder()->first()->id;
        $response = $this->get("/admin/schedules/$id/edit");
        $response
            ->assertStatus(200)
            ->assertSee('Форма редактирования расписания');
    }

    public function testGetCreateSchedulePage()
    {
        $response = $this->get("/admin/schedules/create");
        $response
            ->assertStatus(200)
            ->assertSee('Создание новой записи расписания');
    }
}
