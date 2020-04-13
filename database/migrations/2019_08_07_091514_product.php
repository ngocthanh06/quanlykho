<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('product', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('soluong')->nullable();
            $table->integer('id_category')->nullable();
            $table->string('name')->nullable();
            $table->double('price_after')->nullable();
            $table->double('price_before')->nullable();
            $table->string('dvt')->nullable();
            $table->string('id_supplier')->nullable();
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
        //
        Schema::dropIfExists('product');
    }
}
