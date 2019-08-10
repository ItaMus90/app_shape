<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shapes', function (Blueprint $table) {
            $table->string('id');
            $table->string('shape_name')->unique()->nullable();
            $table->string('shape_type_name');
            $table->json('params');
            $table->float('extent');
            $table->timestamps();
        });

        Schema::table('shapes', function($table) {
            $table->primary(['shape_name','shape_type_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shapes');
    }
}
