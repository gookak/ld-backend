<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transportstatus_id')->unsigned();
            $table->integer('users_id')->unsigned();
            // $table->integer('address_id')->unsigned();
            $table->string('code', 10)->comment('เลขที่ใบสั่งซื้อ');
            $table->integer('sumnumber')->nullable()->comment('รวมจำนวนสินค้าทั้งหมด');
            $table->decimal('sumprice', 10, 2)->nullable()->comment('รวมราคาสินค้าทั้งหมด');
            $table->decimal('fee', 10, 2)->nullable()->comment('ค่าธรรมเนียม');
            $table->decimal('promotion', 10, 2)->nullable()->comment('ส่วนลด');
            $table->decimal('totalprice', 10, 2)->nullable()->comment('ราคาสุทธิ');
            $table->string('emscode', 100)->nullable()->comment('รหัสพัสดุ');
            $table->text('address')->comment('ที่อยู่สำหรับจัดส่ง เก็บเป็น text');
            $table->timestamps();
        });

        Schema::table('order', function($table) {
            $table->foreign('transportstatus_id')->references('id')->on('transport_status'); 
            $table->foreign('users_id')->references('id')->on('users'); 
            // $table->foreign('address_id')->references('id')->on('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order');
    }
}
