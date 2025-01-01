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
        Schema::create('prestations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proprietaire_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('dog_id')->nullable()->constrained()->onDelete('restrict'); // Ajout du champ dog_id
            $table->foreignId('dogsitter_id')->constrained('users')->onDelete('restrict');
            $table->foreignId('prestation_type_id')->nullable()->constrained('prestations_types');
            $table->dateTime('date_debut')->nullable();
            $table->dateTime('date_fin')->nullable();
            $table->decimal('prix',8,2);
            $table->decimal('quantite',8,2);
            $table->decimal('prix_total',8,2);
            $table->enum('statut', ['en cours', 'termine', 'annule', 'en attente de paiement']); 
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestations');
    }
};
