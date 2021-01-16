<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class GetServiceInfoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCorrectService()
    {
        $service_id = Service::query()->inRandomOrder()->first()->id;
        $response = $this->get('/api/services/' . $service_id);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'service' => [
                'address', 'city', 'description', 'email', 'id', 'img_link', 'name', 'phone', 'site', 'skype', 'slug', 'telegram'
            ],
            'schedules' => [
                '*' => ['id', 'work_day', 'work_time', 'order_id', 'name']
            ],
            'types' => [
                '*' => ['name']
            ]
        ]);
    }
}
