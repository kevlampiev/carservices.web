<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('email', 50)->nullable();
            $table->string('site', 150)->nullable();
            $table->string('telegram', 30)->nullable();
            $table->string('skype', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('phone', 'email', 'site', 'telegram', 'skype');
        });
    }
}
