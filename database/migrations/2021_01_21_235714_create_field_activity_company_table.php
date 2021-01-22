<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldActivityCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('field_activity_company', function (Blueprint $table) {
            $table->primary(['company_id', 'field_activity_id']);
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('field_activity_id');

            $table->foreign('company_id')->references('id')->on('companies');
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
        Schema::dropIfExists('field_activity_company');
    }
}
