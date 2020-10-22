<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable(false)->comment('Назвамние по русски');
            $table->string('slug')->unique()->nullable('false');
            $table->string('address')->comment('адрес нахождения');
            $table->point('coordinates')->nullable(true)->comment('географические координаты');
            $table->text('description')->nullable(true)->comment('описание');
            $table->text('img_link')->nullable(true)->comment('фотография');
            $table->bigInteger('user_id')->unsigned()->nullable(true)->comment('ссылка на владельца');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_services');
    }
}
