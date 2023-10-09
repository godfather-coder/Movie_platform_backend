<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->text('image');
            $table->timestamps();
        });
        Schema::create('movie_translation', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('movie_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');

            $table->unique(['movie_id', 'locale']);
            $table->foreign('movie_id')->references('id')->on('movies')->onUpdateCascade();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
        Schema::dropIfExists('movie_translation');
    }
};
