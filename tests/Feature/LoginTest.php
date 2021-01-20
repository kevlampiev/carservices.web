<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCorrectLogin()
    {
        $response = $this->json('POST','/api/login',[
            'email'=> 'admin@admin.ru',
                'password'=> '12345678',
                'rememberMe'=> true]
        );
        $response->assertStatus(200);
        $response->assertJsonStructure(['token']);
    }

    public function testIncorrectEmail()
    {
        $response = $this->json('POST','/api/login',[
                'email'=> 'admin_1@admin.ru',
                'password'=> '12345678',
                'rememberMe'=> true]
        );
        $response->assertStatus(422);
        $response->assertJsonStructure(['errors','message']);
        $response->assertJsonFragment(['The selected email is invalid.']);

    }

    public function testIncorrectPassword()
    {
        $response = $this->json('POST','/api/login',[
                'email'=> 'admin@admin.ru',
                'password'=> '1234567',
                'rememberMe'=> true]
        );
        $response->assertStatus(404);
//        $response->assertJsonStructure(['errors','message']);
//        $response->assertJsonFragment(['The selected email is invalid.']);

    }
}
