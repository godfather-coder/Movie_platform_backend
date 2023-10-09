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
        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('genre_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('genre_id');
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');

            $table->unique(['genre_id', 'locale']);
            $table->foreign('genre_id')->references('id')->on('genres')->onUpdateCascade();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geners');
    }
};
