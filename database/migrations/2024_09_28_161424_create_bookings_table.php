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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->enum('status', ['en attente', 'confirmée', 'terminée', 'annulee']);
            $table->decimal("prix_total",10,2);
            $table->text("commentaire");
            //$table->foreignId('user_id')->constrained()->onDelete('cascade');
            //$table->foreignId('dog_id')->constrained()->onDelete('cascade');
            //$table->foreignId('profile_dog_sitter_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
