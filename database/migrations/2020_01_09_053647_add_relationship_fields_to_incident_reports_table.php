<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipFieldsToIncidentReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incident_reports', function (Blueprint $table) {
            $table->unsignedInteger('nama_pelapor_id')->nullable();

            $table->foreign('nama_pelapor_id', 'nama_pelapor_fk_566287')->references('id')->on('users');

            $table->unsignedInteger('reviewed_by_id')->nullable();

            $table->foreign('reviewed_by_id', 'reviewed_by_fk_566295')->references('id')->on('users');

            $table->unsignedInteger('acknowledge_by_id')->nullable();

            $table->foreign('acknowledge_by_id', 'acknowledge_by_fk_566296')->references('id')->on('users');

            $table->unsignedInteger('dept_designated_id')->nullable();

            $table->foreign('dept_designated_id', 'dept_designations_fk_576010')->references('id')->on('dept_designations');

            $table->unsignedInteger('action_by_id')->nullable();

            $table->foreign('action_by_id', 'action_by_fk_591020')->references('id')->on('users');
            
            $table->unsignedInteger('team_id')->nullable();

            $table->foreign('team_id', 'team_fk_576221')->references('id')->on('teams');

            $table->unsignedInteger('root_cause_id');

            $table->foreign('root_cause_id', 'root_cause_fk_576581')->references('id')->on('root_causes');

            $table->unsignedInteger('result_id');

            $table->foreign('result_id', 'result_fk_591061')->references('id')->on('results');

            $table->unsignedInteger('cat_id');

            $table->foreign('cat_id', 'category_fk_516100')->references('id')->on('category_incidents');

            $table->unsignedInteger('classify_id');

            $table->foreign('classify_id', 'classification_fk_54850')->references('id')->on('classify_incidents');
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
