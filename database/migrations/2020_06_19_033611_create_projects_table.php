<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('long_name', 255);
            $table->string('short_name', 255);
            $table->string('project_scale', 255);
            $table->unsignedDouble('total_area');
            $table->unsignedBigInteger('category_id');
            $table->unsignedDouble('price');
            $table->tinyInteger('price_unit');
            $table->decimal('latitude');
            $table->decimal('longitude');
            $table->longText('project_overview');
            $table->tinyInteger('status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('investor_id');
            $table->unsignedTinyInteger('investor_type');

            // Index
            $table->index('status');
            $table->index(['price', 'price_unit']);
            $table->index('long_name');
            $table->index('short_name');

            // Constraint
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('investor_id')->references('id')->on('investors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
