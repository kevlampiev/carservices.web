<?php

namespace Tests\Feature;

//use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCorrectRegister()
    {
        $response = $this->json('POST', '/api/register', [
                'name' => 'Register Test',
                'email' => 'test' . Date('U') . '@test.ru',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(200)
            ->assertJsonStructure(['user' => ['email', 'id', 'role'], 'token']);
    }

    /**
     * Попытка зарегистрировать юзера без имени
     *
     * @return void
     */
    public function testMissingNameRegister()
    {
        $response = $this->json('POST', '/api/register', [
                'name' => '',
                'email' => 'test' . Date('U') . '@test.ru',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(422)
            ->assertJsonStructure(['errors', 'message'])
            ->assertJsonFragment(['Name required']);
    }

    /**
     * Попытка зарегистрировать юзера с очень длинным именем
     *
     * @return void
     */
    public function testTooLongNameRegister()
    {
        $response = $this->json('POST', '/api/register', [
                'name' => str_repeat('a', 257),
                'email' => 'test' . Date('U') . '@test.ru',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(422)
            ->assertJsonStructure(['errors', 'message'])
            ->assertJsonFragment(['Field Name must be up to 255 characters']);
    }

    /**
     * Попытка зарегистрировать юзера без электронной почты
     *
     * @return void
     */
    public function testMissingEmailRegister()
    {
        $response = $this->json('POST', '/api/register', [
                'name' => 'Register Test',
                'email' => '',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(422)
            ->assertJsonStructure(['errors', 'message'])
            ->assertJsonFragment(['Email required']);
    }

    /**
     * Попытка зарегистрировать юзера c черте чем вместо почты
     *
     * @return void
     */
    public function testInvalidEmailRegister()
    {
        $response = $this->json('POST', '/api/register', [
                'name' => 'Register Test',
                'email' => 'admin.ru',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(422)
            ->assertJsonStructure(['errors', 'message'])
            ->assertJsonFragment(['Email has a wrong format']);
    }

    /**
     * Попытка зарегистрировать юзера с имеющимся e-mail
     *
     * @return void
     */
    public function testExistingEmailRegister()
    {
        $response = $this->json('POST', '/api/register', [
                'name' => 'Register Test',
                'email' => 'admin@admin.ru',
                'password' => '12345678',
                'rememberMe' => true]
        );
        $response->assertStatus(422)
            ->assertJsonStructure(['errors', 'message'])
            ->assertJsonFragment(['User with this e-mail already exists']);
    }

    /**
     * Попытка зарегистрировать юзера без пароля
     *
     * @return void
     */
    public function testMissingPasswordRegister()
    {
        $response = $this->json('POST', '/api/register', [
                'name' => 'Register Test',
                'email' => 'test' . Date('U') . '@test.ru',
                'password' => '',
                'rememberMe' => true]
        );
        $response->assertStatus(422)
            ->assertJsonStructure(['errors', 'message'])
            ->assertJsonFragment(['Password required']);
    }

    /**
     * Попытка зарегистрировать юзера со слишком коротким паролем
     *
     * @return void
     */
    public function testTooShotPasswordRegister()
    {
        $response = $this->json('POST', '/api/register', [
                'name' => 'Register Test',
                'email' => 'test' . Date('U') . '@test.ru',
                'password' => '123',
                'rememberMe' => true]
        );
        $response->assertStatus(422)
            ->assertJsonStructure(['errors', 'message'])
            ->assertJsonFragment(['The password is too shot. At least 8 characters required']);
    }


}
