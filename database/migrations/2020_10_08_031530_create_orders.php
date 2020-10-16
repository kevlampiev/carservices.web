<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('car_model')->nullable('true')->comment('свободное описание марки авто');
            $table->string('license_plate_number')->nullable(true)->comment('государственный регистрационный номер автомобиля');
            $table->text('description')->nullable(true)->comment('описание проблемы');
            $table->enum('order_status', ['in_waiting', 'confirmed', 'deny'])->default('in_waiting')->comment('статусы заказа');
            $table->dateTime('status_date')->nullable(true)->comment('дата/время выставления автосервисом статуса заказа');
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
        Schema::dropIfExists('orders');
    }
}
