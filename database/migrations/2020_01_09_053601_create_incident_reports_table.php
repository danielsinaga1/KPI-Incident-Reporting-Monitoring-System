<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncidentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incident_reports', function (Blueprint $table) {
            $table->increments('id');

            $table->string('no_laporan');

            $table->string('perbaikan')->nullable();

            $table->string('pencegahan')->nullable();

            $table->string('location');

            $table->string('description');

            $table->string('status')->nullable;

            $table->datetime('date_incident');

            $table->datetime('date_dept_action')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incident_reports');
    }
}
