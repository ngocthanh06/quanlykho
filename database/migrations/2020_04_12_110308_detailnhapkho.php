<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Detailnhapkho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitietnhapkho', function (Blueprint $table) {
            $table->integer('id_nhapkho');
            $table->integer('id_SP')->nullable();
            $table->text('dvt')->nullable();
            $table->integer('soluong')->nullable();
            $table->double('gianhap')->nullable();
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
        Schema::dropIfExists('chitietnhapkho');
    }
}
