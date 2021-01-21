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
        $response = $this->json('POST', '/api/login', [
                'email' => 'admin@admin.ru',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(200);
        $response->assertJsonStructure(['user' => ['email', 'id', 'role'], 'token']);
    }

    /**
     * ЗАпрос с неправильныи e-mail (проходит валидацию, но нет такого юзера)
     */
    public function testIncorrectEmail()
    {
        $response = $this->json('POST', '/api/login', [
                'email' => 'incorrectadmin@admin.ru',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(422);
        $response->assertJsonStructure(['errors', 'message']);
        $response->assertJsonFragment(['No such user']);
    }

    /**
     * Запрос с невалидным e-mail
     */
    public function testInvalidEmail()
    {
        $response = $this->json('POST', '/api/login', [
                'email' => 'incorrectadmin.ru',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(422);
        $response->assertJsonStructure(['errors', 'message']);
        $response->assertJsonFragment(['Email has a wrong format']);
    }

    /**
     * Login без e-mail
     */
    public function testMissingEmail()
    {
        $response = $this->json('POST', '/api/login', [
                'email' => '',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(422);
        $response->assertJsonStructure(['errors', 'message']);
        $response->assertJsonFragment(['Email required']);
    }

    /**
     *Запрос со слищком коротким паролем (не проходит валидацию)
     */
    public function testInvalidPassword()
    {
        $response = $this->json('POST', '/api/login', [
                'email' => 'admin@admin.ru',
                'password' => '1234567',
                'rememberMe' => true]
        );
        $response->assertStatus(422);

    }

    /**
     *Запрос с неверным паролем
     */
    public function testIncorrectPassword()
    {
        $response = $this->json('POST', '/api/login', [
                'email' => 'admin@admin.ru',
                'password' => '1234567',
                'rememberMe' => true]
        );
        $response->assertStatus(422);
    }

    /**
     * Login без пароля
     */
    public function testMissingPassword()
    {
        $response = $this->json('POST', '/api/login', [
                'email' => 'admin@admin.ru',
                'password' => '',
                'rememberMe' => true]
        );
        $response->assertStatus(422)
            ->assertJsonStructure(['errors', 'message'])
            ->assertJsonFragment(['Password required']);;
    }
}
