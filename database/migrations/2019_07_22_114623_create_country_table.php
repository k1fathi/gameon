<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountryTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->timestamps();
        });

        Schema::create('country_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('locale')->index();

            $table->integer('country_id')->unsigned();
            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['country_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_translations');
        Schema::dropIfExists('countries');
    }
}
