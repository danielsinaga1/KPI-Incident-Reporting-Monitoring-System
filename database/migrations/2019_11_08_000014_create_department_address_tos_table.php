<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentAddressTosTable extends Migration
{
    public function up()
    {
        Schema::create('department_address_tos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('cc_code')->unique();

            $table->string('dept_name_address');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
