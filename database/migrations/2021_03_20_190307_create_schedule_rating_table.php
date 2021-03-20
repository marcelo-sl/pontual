<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_rating', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('rate');

            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')->references('id')->on('schedules');
            
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedule_rating');
    }
}
