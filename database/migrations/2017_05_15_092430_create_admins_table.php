<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('name');
            $table->string('tel', 100)->nullable()->comment('เบอร์ติดต่อ');
            $table->string('avatar', 100)->nullable()->comment('รูปภาพ');
            $table->text('address')->nullable()->comment('ที่อยู่');
            $table->string('gender', 100)->nullable()->comment('เพศ');
            $table->date('birthday')->nullable()->comment('วันเกิด');
            $table->string('avatar', 100)->comment('รูปภาพ');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            
            
        });

        Schema::table('admins', function($table) {
            $table->foreign('role_id')->references('id')->on('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
