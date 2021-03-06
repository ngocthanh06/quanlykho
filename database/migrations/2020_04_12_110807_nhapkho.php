<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Nhapkho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhapkho', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user_id')->nullable();
            $table->text('Noidung')->nullable();
            $table->integer('id_nhasx')->nullable();
            $table->double('Tongtien')->nullable();
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
        Schema::dropIfExists('nhapkho');
    }
}
