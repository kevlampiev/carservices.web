<?php

namespace Tests\Feature;

use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServicesListTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testMainPage()
    {
        $city = Service::query()->select('city')->inRandomOrder()->first()->city;
        $response = $this->get('/api/services?city=' . $city);
        $response->assertStatus(200);

    }
}
