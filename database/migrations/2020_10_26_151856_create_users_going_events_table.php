<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD:vendor/laravel/framework/src/Illuminate/Cache/Console/stubs/cache.stub
class CreateCacheTable extends Migration
=======
class CreateUsersGoingEventsTable extends Migration
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change:database/migrations/2020_10_26_151856_create_users_going_events_table.php
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD:vendor/laravel/framework/src/Illuminate/Cache/Console/stubs/cache.stub
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->unique();
            $table->mediumText('value');
            $table->integer('expiration');
=======
        Schema::create('users_going_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('userid');
            $table->integer('eventid');
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change:database/migrations/2020_10_26_151856_create_users_going_events_table.php
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD:vendor/laravel/framework/src/Illuminate/Cache/Console/stubs/cache.stub
        Schema::dropIfExists('cache');
=======
        Schema::dropIfExists('users_going_events');
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change:database/migrations/2020_10_26_151856_create_users_going_events_table.php
    }
}
