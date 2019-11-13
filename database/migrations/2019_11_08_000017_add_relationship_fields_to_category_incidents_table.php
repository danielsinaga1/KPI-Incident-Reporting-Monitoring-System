<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCategoryIncidentsTable extends Migration
{
    public function up()
    {
        Schema::table('category_incidents', function (Blueprint $table) {
            $table->unsignedInteger('team_id')->nullable();

            $table->foreign('team_id', 'team_fk_575864')->references('id')->on('teams');
        });
    }
}
