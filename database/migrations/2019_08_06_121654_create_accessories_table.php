<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccessoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accessories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
        });
        Schema::create('accessory_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('locale')->index();

            $table->bigInteger('accessory_id')->unsigned();
            $table->foreign('accessory_id')
                ->references('id')
                ->on('accessories')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['accessory_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accessory_translations');
        Schema::dropIfExists('accessories');
    }
}
