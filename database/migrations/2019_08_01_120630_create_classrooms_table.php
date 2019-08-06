<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('number');
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });

        Schema::create('classroom_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->json('label')->nullable();
            $table->string('locale')->index();

            $table->bigInteger('classrooms_id')->unsigned();
            $table->foreign('classrooms_id')
                ->references('id')
                ->on('classrooms')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['classrooms_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classroom_translations');
        Schema::dropIfExists('classrooms');
    }
}
