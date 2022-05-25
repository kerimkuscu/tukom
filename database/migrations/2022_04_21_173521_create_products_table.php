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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('card_code');
            $table->string('description');
            $table->string('type');
            $table->string('brand')->nullable();
            $table->integer('fiili_stok')->nullable();
            $table->integer('actual_stock')->nullable();
            $table->string('main_unit')->nullable();
            $table->integer('price')->nullable();
            $table->string('currency')->nullable();
            $table->string('group_code')->nullable();
            $table->string('image')->nullable();
            $table->string('special_code_1')->nullable();
            $table->string('special_code_2')->nullable();
            $table->string('special_code_3')->nullable();
            $table->string('special_code_4')->nullable();
            $table->string('special_code_5')->nullable();
            $table->string('special_code_6')->nullable();
            $table->string('special_code_7')->nullable();
            $table->string('special_code_8')->nullable();
            $table->string('special_code_9')->nullable();
            $table->string('special_code_10')->nullable();
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
        Schema::dropIfExists('products');
    }
};
