<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

<<<<<<< HEAD
class CreateEventsTable extends Migration
=======
<<<<<<< HEAD:vendor/laravel/framework/src/Illuminate/Queue/Console/stubs/failed_jobs.stub
class Create{{tableClassName}}Table extends Migration
=======
class CreateEventsTable extends Migration
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change:database/migrations/2020_10_17_223201_create_events_table.php
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
=======
<<<<<<< HEAD:vendor/laravel/framework/src/Illuminate/Queue/Console/stubs/failed_jobs.stub
        Schema::create('{{table}}', function (Blueprint $table) {
=======
        Schema::create('events', function (Blueprint $table) {
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change:database/migrations/2020_10_17_223201_create_events_table.php
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('userid');
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change
            $table->string('event_name');
            $table->date('start_date');
            $table->date('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
<<<<<<< HEAD
        Schema::dropIfExists('events');
=======
<<<<<<< HEAD:vendor/laravel/framework/src/Illuminate/Queue/Console/stubs/failed_jobs.stub
        Schema::dropIfExists('{{table}}');
=======
        Schema::dropIfExists('events');
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change:database/migrations/2020_10_17_223201_create_events_table.php
>>>>>>> feature/TEAM-15-User_implementation_and_gui_change
    }
}
