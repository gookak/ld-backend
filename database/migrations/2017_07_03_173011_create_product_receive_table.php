<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductReceiveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_receive', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('admins_id')->unsigned()->comment('ผู้สร้าง');
            $table->integer('number')->comment('จำนวน');
            $table->text('note')->nullable()->comment('หมายเหตุ');
            $table->timestamps();
        });

        Schema::table('product_receive', function($table) {
            $table->foreign('product_id')->references('id')->on('product');
        });
        Schema::table('product_receive', function($table) {
            $table->foreign('admins_id')->references('id')->on('admins');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_receive');
    }
}
