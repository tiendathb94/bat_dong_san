<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImageLibrariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_libraries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('library_type');
            $table->string('file_path');
            $table->string('image_libraryable_type', 255);
            $table->unsignedBigInteger('image_libraryable_id');
            $table->longText('meta_data')->nullable();
            $table->unsignedBigInteger('user_id');

            $table->index(['library_type']);
            $table->index(['image_libraryable_type', 'image_libraryable_id'], 'libraryable_idx');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('image_libraries');
    }
}
