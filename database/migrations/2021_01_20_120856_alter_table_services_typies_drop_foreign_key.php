<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableServicesTypiesDropForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services_types', function (Blueprint $table) {
            $table->dropForeign('services_types_service_id_foreign');
            $table->dropForeign('services_types_type_id_foreign');

            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services_types', function (Blueprint $table) {
            $table->dropForeign('services_types_service_id_foreign');
            $table->dropForeign('services_types_type_id_foreign');

            $table->foreign('service_id')->references('id')->on('services');
            $table->foreign('type_id')->references('id')->on('types');
        });
    }
}
