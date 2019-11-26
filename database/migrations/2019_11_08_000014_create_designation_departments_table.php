<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('dept_designations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('cc_code')->unique();

            $table->string('name');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
