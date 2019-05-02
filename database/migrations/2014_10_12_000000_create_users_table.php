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
            $table->bigIncrements('id');
            $table->string('lname');
            $table->string('fname');
            $table->string('gender',1);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('school');
            $table->string('school_address');
            $table->string('designation');
            $table->string('tmp_password')->nullable();
            $table->boolean('admin')->default(0);
            $table->boolean('candidate')->default(0);
            $table->timestamp('voted_on')->nullable();
            $table->boolean('active')->default(0);
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
