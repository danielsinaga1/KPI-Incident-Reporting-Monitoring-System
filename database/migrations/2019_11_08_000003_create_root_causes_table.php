<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRootCausesTable extends Migration
{
    public function up()
    {
        Schema::create('root_causes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('root_cause');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
