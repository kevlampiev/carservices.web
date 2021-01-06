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
        Schema::create('services_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->comment('ссылка на таблицу services_');
            $table->unsignedBigInteger('type_id')->comment('ссылка на таблицу servicetypes');

            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('type_id')->references('id')->on('types');
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
        Schema::dropIfExists('services_types');
    }
}
