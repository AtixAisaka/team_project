<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEventsType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->integer('type');
            $table->integer('idfakulty');
            $table->integer('idkatedry');
            $table->string('event_place');
            $table->boolean('ishidden');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('idfakulty');
            $table->dropColumn('idkatedry');
            $table->dropColumn('event_place');
            $table->dropColumn('ishidden');
        });
    }
}
