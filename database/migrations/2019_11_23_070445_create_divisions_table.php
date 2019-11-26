<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('general_manager_id')->unsigned();
            $table->integer('manager_id')->unsigned();
            $table->integer('superintendent_id')->unsigned();
            $table->integer('supervisor_id')->unsigned();
            $table->integer('member_id')->unsigned();
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('leader_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('member_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('divisions');
    }
}
