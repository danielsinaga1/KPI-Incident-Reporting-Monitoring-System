<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationIncidentsTable extends Migration
{
    public function up()
    {
        Schema::create('classification_incidents', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('code');

            $table->string('type');

            $table->longText('description');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
