<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationshipFieldsToClassifyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('classify_details', function (Blueprint $table) {
            $table->unsignedInteger('cat_id');

            $table->foreign('cat_id', 'category_incident_fk_589200')->references('id')->on('category_incidents');

            $table->unsignedInteger('classify_id');

            $table->foreign('classify_id', 'classify_fk_575674')->references('id')->on('classify_incidents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classify_details');
    }
}
