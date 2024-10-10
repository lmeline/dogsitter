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
            $table->integer('note');
            $table->text('commentaire');
            $table->timestamps();
            //$table->foreignId('user_id')->constrained()->onDelete('cascade');
            //$table->foreignId('booking_id')->constrained()->onDelete('cascade');
            //$table->foreignId('profile_dog_sitter_id')->constrained()->onDelete('cascade');
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
