<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarServicesServiceType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::create('car_services_service_type', function (Blueprint $table) {
//            $table->id();
//            $table->unsignedBigInteger('car_service_id')->comment('ссылка на таблицу car_services');
//            $table->unsignedBigInteger('service_type_id')->comment('ссылка на таблицу service_types');
//            $table->timestamps();
//            $table->foreign('car_service_id')->on('car_services')->references('id');
//            $table->foreign('service_type_id')->on('service_types')->references('id');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_services_service_type');
    }
}
