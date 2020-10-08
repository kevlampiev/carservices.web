<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterServicesListsAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Добавляем foreign key когда все таблицы гарантировано созданы
        Schema::table('services_lists', function(Blueprint $table) {
            $table->foreign('service_type_id')->references('id')->on('service_types');
            $table->foreign('car_service_id')->references('id')->on('car_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Удаляем fk
        Schema::table('services_lists', function(Blueprint $table) {
            $table->dropForeign('services_lists_car_service_id_foreign');
            $table->dropForeign('services_lists_service_type_id_foreign');
        });

    }
}
