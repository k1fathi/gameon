<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRosettesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('rosettes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });


        Schema::create('rosette_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('locale')->index();

            $table->bigInteger('rosette_id')->unsigned();
            $table->foreign('rosette_id')
                ->references('id')
                ->on('rosettes')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['rosette_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rosette_translations');
        Schema::dropIfExists('rosettes');
    }
}
