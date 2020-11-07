<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });

        Schema::create('events_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('events_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->unique(['events_id','tag_id']);

            $table->foreign('events_id')->references('id')->on('Events'); //before also had ->onDelete('cascade') this probably wont be needed
            $table->foreign('tag_id')->references('id')->on('tags'); //before also had ->onDelete('cascade') this probably wont be needed

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('events_tag');
    }
}
