<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('description');
            $table->Integer('point');
            $table->Integer('gold');
            $table->Integer('experience');
            $table->string('classroom');
            $table->text('related_fields');
            $table->text('favorite_games');
            $table->text('avatar');//{'necklace'=>['image_id'=>image_table_id_goes_here,'id'=>necklace_table_id_goes_here,'name'=>'necklace_name_field']}
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
