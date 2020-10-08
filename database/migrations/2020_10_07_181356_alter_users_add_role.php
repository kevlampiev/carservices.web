<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersAddRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Добавляем роль
        Schema::table('users', function(Blueprint $table) {
            $table->enum('role',['client','service_owner','admin'])->default('client');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Удаляем роль
        Schema::table('users',function(Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}
