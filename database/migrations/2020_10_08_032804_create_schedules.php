<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedules extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('work_day')->nullable(false)->comment('дата работы');
            $table->float('work_time', 4, 2)->unsigned()->default(9)->comment('Время приема');
            $table->unsignedBigInteger('service_type_id')->nullable(true)->comment('виды оказываемых услуг в это время');
            $table->unsignedBigInteger('order_id')->nullable(true)->comment('какой заказ поступил на это время');
            $table->timestamps();
            $table->foreign('service_type_id')->references('id')->on('service_types');
            $table->foreign('order_id')->references('id')->on('orders');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
