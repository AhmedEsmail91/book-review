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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->text('review');// the text written from the reviewer
            $table->unsignedTinyInteger('rating');
            $table->timestamps();

            // Adding the relation between the book and reviews
            // $table->unsignedBigInteger('book_id');
            // $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            //or Simply:
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
