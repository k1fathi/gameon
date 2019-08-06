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
    });

        Schema::create('classroom_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->json('label')->nullable();
            $table->string('locale')->index();

            $table->bigInteger('classroom_id')->unsigned();
            $table->foreign('classroom_id')
                ->references('id')
                ->on('classrooms')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['classroom_id', 'locale']);
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
