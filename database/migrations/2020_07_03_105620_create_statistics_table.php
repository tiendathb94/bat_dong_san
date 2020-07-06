<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('day_id');
            $table->string('value');
            $table->string('statisticable_type');
            $table->unsignedBigInteger('statisticable_id');
            $table->index(['name', 'statisticable_type', 'statisticable_id']);
            $table->index(['day_id', 'statisticable_type', 'statisticable_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistics');
    }
}
