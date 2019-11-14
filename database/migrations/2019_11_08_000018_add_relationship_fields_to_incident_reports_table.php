<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIncidentReportsTable extends Migration
{
    public function up()
    {
        Schema::table('incident_reports', function (Blueprint $table) {
            $table->unsignedInteger('nama_pelapor_id')->nullable();

            $table->foreign('nama_pelapor_id', 'nama_pelapor_fk_566287')->references('id')->on('users');

            $table->unsignedInteger('reviewed_by_id')->nullable();

            $table->foreign('reviewed_by_id', 'reviewed_by_fk_566295')->references('id')->on('users');

            $table->unsignedInteger('acknowledge_by_id')->nullable();

            $table->foreign('acknowledge_by_id', 'acknowledge_by_fk_566296')->references('id')->on('users');

            $table->unsignedInteger('dept_addressed_to_id')->nullable();

            $table->foreign('dept_addressed_to_id', 'dept_addressed_to_fk_576010')->references('id')->on('department_address_tos');

            $table->unsignedInteger('team_id')->nullable();

            $table->foreign('team_id', 'team_fk_576221')->references('id')->on('teams');

            $table->unsignedInteger('root_cause_id');

            $table->foreign('root_cause_id', 'root_cause_fk_576581')->references('id')->on('root_causes');

        });
    }
}
