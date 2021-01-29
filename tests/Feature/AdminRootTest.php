<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminRootTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCitiesList()
    {
        $response = $this->get('/admin')
            ->assertStatus(200)
            ->assertSee('Выбирите');
    }
}
