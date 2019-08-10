<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShapeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shape_types', function (Blueprint $table) {
            $table->string('id');
            $table->string('shape_type_name');
        });

        Schema::table('shape_types', function($table) {
            $table->primary(['shape_type_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shape_types');
    }
}
