<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_image', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->integer('fileupload_id')->unsigned();
            //$table->string('filename', 100)->comment('ชื่อไฟล์');
            // $table->string('filetype', 50)->comment('นามสกุล');
            $table->integer('sort')->comment('เรียง');
            $table->boolean('statusdefault')->default(false)->comment('ตั้งค่าเป็น defualt');
            $table->timestamps();
        });

        Schema::table('product_image', function($table) {
            $table->foreign('product_id')->references('id')->on('product');
            $table->foreign('fileupload_id')->references('id')->on('fileupload');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_image');
    }
}
