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
        Schema::create('users_prestations_types', function (Blueprint $table) {
            $table->id();
            $table->decimal('prix',8,2);
            $table->foreignId('dogsitter_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('prestation_type_id')->constrained('prestations_types')->onDelete('cascade'); 
            $table->unique(['dogsitter_id', 'prestation_type_id']);  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_prestations_types');
    }
};
