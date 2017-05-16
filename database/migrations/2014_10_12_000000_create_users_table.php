<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('name', 200)->comment('ชื่อ');
            // $table->string('firstname', 200)->comment('ชื่อ');
            // $table->string('lastname', 200)->comment('นามสกุล');
            // $table->string('tel', 100)->comment('เบอร์ติดต่อ');
            // $table->string('avatar', 100)->comment('รูปภาพ');
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
        Schema::dropIfExists('users');
    }
}
