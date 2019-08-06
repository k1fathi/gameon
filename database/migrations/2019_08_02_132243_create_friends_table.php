<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFriendsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
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

        Schema::create('friend
        _translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('category')->nullable();
            $table->json('label')->nullable();
            $table->string('locale')->index();

            $table->bigInteger('friends_id')->unsigned();
            $table->foreign('friends_id')
                ->references('id')
                ->on('friends')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unique(['friends_id', 'locale']);
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friends');
        //Schema::dropIfExists('friend_translations');
    }
}
