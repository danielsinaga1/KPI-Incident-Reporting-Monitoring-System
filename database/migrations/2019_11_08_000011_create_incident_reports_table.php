<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncidentReportsTable extends Migration
{
    public function up()
    {
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->increments('id');

            $table->string('perbaikan');

            $table->string('pencegahan');

            $table->string('location');

            $table->datetime('date_incident');

            $table->date('date_dept_action')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
