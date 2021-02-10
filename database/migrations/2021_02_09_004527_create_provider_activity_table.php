<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_activity', function (Blueprint $table) {
            $table->primary(['provider_id', 'field_activity_id']);
            $table->unsignedBigInteger('provider_id');
            $table->unsignedBigInteger('field_activity_id');

            $table->foreign('provider_id')->references('id')->on('providers');
            $table->foreign('field_activity_id')->references('id')->on('fields_activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('provider_activity');
    }
}
