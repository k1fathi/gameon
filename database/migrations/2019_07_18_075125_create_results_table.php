<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->timestamps();

            $table->morphs('resultable');
        });

        Schema::create('result_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('description')->nullable();
            $table->string('locale')->index();

            $table->bigInteger('result_id')->unsigned();
            $table->foreign('result_id')
                ->references('id')
                ->on('results')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['result_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rosettes');
    }
}
