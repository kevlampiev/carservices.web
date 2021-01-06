<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CitiesListTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCitiesList()
    {
        $response = $this->get('/api/services/cities');
        $response->assertStatus(200);
        $response->assertJsonStructure(['*'=>['city']]);
    }
}
