<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailXuatkhosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailxuatkhos', function (Blueprint $table) {
            $table->integer('id_xuatkho')->nullable();
            $table->integer('id_SP')->nullable();
            $table->integer('sl')->nullable();
            $table->double('giaxuat')->nullable();
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
        Schema::dropIfExists('detailxuatkhos');
    }
}
