<?php

namespace Tests\Feature;

use App\Models\Schedule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditScheduleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEdit()
    {
        $id = Schedule::query()->inRandomOrder()->first()->id;

        $response = $this->get("http://carservices.local/admin/schedules/$id/edit")
            ->assertStatus(200)
            ->assertSee('Форма редактирования расписания');
    }
}
