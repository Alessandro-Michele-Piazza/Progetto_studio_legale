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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');          // Titolo dell'articolo
            $table->string('slug')->unique(); // URL amichevole (es. il-diritto-civile-oggi)
            $table->text('body');             // Il contenuto vero e proprio dell'articolo
            $table->string('category');       // La categoria (Amministrativo, Civile, ecc.)
            $table->string('image')->nullable(); // Una foto per l'articolo (opzionale)
            $table->timestamps();             // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
