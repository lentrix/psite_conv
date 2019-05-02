<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->bigInteger('voter_id')->unsigned();
            $table->bigInteger('candidate_id')->unsigned();
            $table->boolean('valid')->default(1);

            $table->foreign('voter_id')->references('id')->on('users');
            $table->foreign('candidate_id')->references('id')->on('users');

            $table->primary(['voter_id', 'candidate_id']);
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
        Schema::dropIfExists('votes');
    }
}
