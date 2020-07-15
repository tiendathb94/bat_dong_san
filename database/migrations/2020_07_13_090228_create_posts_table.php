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
            $table->tinyInteger('price_unit')->nullable();
            $table->tinyInteger('status');
            $table->double('facade')->nullable();
            $table->double('way_in')->nullable();
            $table->integer('direction_house')->nullable();
            $table->integer('direction_balcony')->nullable();
            $table->integer('number_of_floors')->nullable();
            $table->integer('number_of_bedroom')->nullable();
            $table->integer('number_of_toilet')->nullable();
            $table->string('furniture', 255)->nullable();
            $table->string('legal_information', 255)->nullable();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedDouble('total_area')->nullable();
            $table->unsignedBigInteger('category_id');
            $table->unsignedDouble('price')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->integer('total_price')->nullable();
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
