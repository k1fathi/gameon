<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('width');
            $table->integer('height');
            $table->string('key')->nullable();

            $table->string('version')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->string('original_url')->nullable()->index();

            $table->timestamps();
            $table->softDeletes();

            $table->string('imageable_type');
            $table->string('imageable_id');
            $table->index(['imageable_type', 'imageable_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('images');
    }
}
