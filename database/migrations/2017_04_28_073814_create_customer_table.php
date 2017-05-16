<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->increments('id');
            // $table->string('email')->unique();
            // $table->string('password');
            // $table->string('firstname', 200)->nullable()->comment('ชื่อ');
            // $table->string('lastname', 200)->nullable()->comment('นามสกุล');
            // $table->string('tel', 100)->nullable()->comment('เบอร์ติดต่อ');
            // $table->string('image', 100)->nullable()->comment('รูป');
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
        Schema::dropIfExists('customer');
    }
}
