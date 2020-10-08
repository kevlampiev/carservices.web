<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_type_id')->comment('ссылка на таблицу service_types');
            $table->unsignedBigInteger('car_service_id')->comment('ссылка на таблицу car_services');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services_lists');
    }
}
