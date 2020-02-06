<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();

            $table->foreign('team_id', 'team_fk_575684')->references('id')->on('teams');
            
            $table->unsignedInteger('role_id')->nullable();
            
            $table->foreign('role_id', 'role_fk_575284')->references('id')->on('roles');

            $table->unsignedInteger('job_id')->nullable();

            $table->foreign('job_id', 'job_title_fk_581984')->references('id')->on('job_titles');
        });
    }
}
