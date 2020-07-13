<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug', 255);
            $table->tinyInteger('form');
            $table->longText('content');
            $table->tinyInteger('price_unit');
            $table->tinyInteger('status');
            $table->double('facade');
            $table->double('way_in');
            $table->integer('direction_house');
            $table->integer('direction_balcony');
            $table->integer('number_of_floors');
            $table->integer('number_of_bedroom');
            $table->integer('number_of_toilet');
            $table->string('furniture', 255);
            $table->string('legal_information', 255);
            $table->unsignedBigInteger('project_id');
            $table->unsignedDouble('total_area')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedDouble('price');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            // Index
            $table->index('status');
            $table->index(['price', 'price_unit']);
            $table->index('form');
            $table->index('direction_house');
            $table->index('number_of_floors');
            $table->index('total_area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
