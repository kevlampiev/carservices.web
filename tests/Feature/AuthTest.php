<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRegister()
    {
        $response = $this->post('/register');
//        проверяем ответ контроллера на ответ Status 201
        $response->assertStatus('201');

    }

    public function testLogin() {
        $response = $this->post('/login');
//        проверяеи контроллер на возвращаемое значение, объект класса user в формате json
        $response->assertJson();
    }
}
