<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRoleColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->integer('status')->default(0)->comment('1 Active, 0 InActive')->after('profile_photo_path');
            $table->integer('is_admin')->default(0)->comment('1 Admin, 0 - TeleCaller , 2 - Backend');
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
            // $table->dropColumn('status');
            $table->dropColumn('is_admin');
        });


    }
}
