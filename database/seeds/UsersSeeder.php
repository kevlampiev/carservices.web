<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Администратор',
            'email' => 'admin@admin.ru',
            'email_verified_at' => now(),
            'password' => \Illuminate\Support\Facades\Hash::make('12345678'),
            'created_at' => now(),
            'role' => 'admin'
        ]);
        //все остальные, не админы
        factory(App\User::class, 10)->create();
    }

}
