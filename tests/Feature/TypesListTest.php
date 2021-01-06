<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TypesListTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCitiesList()
    {
        $response = $this->get('/api/services/types');
        $response->assertStatus(200);
        $response->assertJsonStructure(['*'=>['name']]);
    }
}
