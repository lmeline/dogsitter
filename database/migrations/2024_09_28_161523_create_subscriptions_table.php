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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('abonnement', ['annuel', 'mensuel','trimestriel']);
            $table->decimal('tarif', 10, 2);
            $table->date('date_debut');
            $table->date('date_fin');
            $table->date('date_paiement');
            $table->enum ('statut', ['actif', 'expiré', 'annulé']);
            //$table->foreignId('profile_dog_sitter_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
