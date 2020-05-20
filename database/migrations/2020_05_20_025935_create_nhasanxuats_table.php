<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhasanxuatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhasanxuats', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('TenNSX')->nullable();
            $table->string('Email')->nullable();
            $table->string('SDT')->nullable();
            $table->string('address')->bullable();
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
        Schema::dropIfExists('nhasanxuats');
    }
}
