<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesServicetypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services_servicetypes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->comment('ссылка на таблицу services_');
            $table->unsignedBigInteger('service_type_id')->comment('ссылка на таблицу servicetypes');

            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('service_type_id')->references('id')->on('servicetypes');
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
        Schema::dropIfExists('services_servicetypes');
    }
}
