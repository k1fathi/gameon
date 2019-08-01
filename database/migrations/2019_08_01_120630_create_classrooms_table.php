<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number');
            $table->timestamps();
        });

        Schema::create('classrooms_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->json('extension')->nullable();
            $table->string('locale')->index();

            $table->integer('classrooms_id')->unsigned();
            $table->foreign('classrooms_id')->references('id')->on('classrooms')->onUpdate('cascade')->onDelete('cascade');

            $table->unique(['classrooms_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classrooms');
    }
}
