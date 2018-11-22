<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('text');
            $table->integer('user_id')->references('id')->on('users');
            $table->integer('theme_id')->references('id')->on('themes');
            $table->text('image')->nullable();
            $table->integer('likes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
      $table->integer('car_id')->references('id')->on('cars');
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
