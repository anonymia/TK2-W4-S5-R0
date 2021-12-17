<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role',  ['user', 'admin'])->default('admin');
            $table->string('place_of_birth')->default('');
            $table->date('date_of_birth')->default('2000-1-1');
            $table->boolean('gender')->default(false);
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
            $table->dropColumn('role');
            $table->dropColumn('place_of_birth');
            $table->dropColumn('date_of_birth');
            $table->dropColumn('gender');
        });
    }
}
