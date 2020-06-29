<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOnUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('avatar')->nullable();
            $table->string('facebook')->nullable();
            $table->string('skype')->nullable();
            $table->string('zalo')->nullable();
            $table->string('viber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('avatar');
            $table->dropColumn('facebook');
            $table->dropColumn('skype');
            $table->dropColumn('zalo');
            $table->dropColumn('viber');
        });
    }
}
