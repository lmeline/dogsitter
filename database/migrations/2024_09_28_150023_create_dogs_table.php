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
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();
            $table->string('nom',70)->index()->nullable(false);
            $table->string('race',70)->index()->nullable(false);
            $table->integer('age')->index()->nullable(false);
            $table->integer('poids')->nullable(false);
            $table->text('comportement')->nullable(true);
            $table->text('besoins_speciaux')->nullable(true);
            $table->enum('sexe', ['M', 'F'])->index();
            $table->string('photo')->nullable();
            $table->boolean('sterilise')->index()->default(false);
            $table->foreignId('proprietaire_id')->constrained('users')->onDelete('restrict');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dogs');
    }
};
