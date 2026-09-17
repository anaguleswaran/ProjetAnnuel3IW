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
        Schema::create('exceptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('depense_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->foreignId('revenu_id')
                ->nullable()
                ->constrained()
                ->cascadeOnDelete();
            $table->string('nom', 80);
            $table->text('description')->nullable();
            $table->decimal('montant', 10, 2);
            $table->date('date_debut');
            $table->boolean('frequence')->default(false);
            $table->date('date_fin')->nullable();
            $table->integer('duree')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exceptions');
    }
};
