<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('title');
            $table->string('business');
            $table->string('company');
            $table->string('address');
            $table->string('city_state_zip_country');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('connector_interested_in');
            $table->string('connector_supplier');
            $table->string('eau');
            $table->string('project_title');
            $table->string('project_start_date');
            $table->string('questions_comments');
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
        Schema::dropIfExists('quotes');
    }
};
