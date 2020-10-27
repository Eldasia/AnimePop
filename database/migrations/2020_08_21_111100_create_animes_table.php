<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animes', function (Blueprint $table) {
            $table->id();
            $table->integer('mal_id')->unique();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('mal_url');
            $table->string('img_url');
            $table->string('genre');
            $table->text('synopsis');
            $table->integer('episodes');
            $table->datetime('start_diff')->nullable();
            $table->datetime('end_diff')->nullable();
            $table->string('rated');
            $table->timestamps();
        });

        Schema::create('anime_user', function (Blueprint $table) {
            $table->foreignId('anime_id')->constrained('animes');
            $table->foreignId('user_id')->constrained('users');
            $table->boolean('is_viewed')->default(false)->index();
            $table->timestamps();
            $table->index(['anime_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animes');
        Schema::dropIfExists('anime_user');
    }
}
