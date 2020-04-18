<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateXuatKhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('xuat_khos', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('user_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->text('Noidung')->nullable();
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
        Schema::dropIfExists('xuat_khos');
    }
}
