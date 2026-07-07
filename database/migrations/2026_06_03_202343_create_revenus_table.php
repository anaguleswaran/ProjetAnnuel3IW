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
        Schema::create('revenus', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 80);
            $table->text('description')->nullable();
            $table->integer('duree')->nullable();
            $table->boolean('ponctuel')->default(false);
            $table->date('date_debut')->nullable();
            $table->date('date_fin')->nullable();
            $table->integer('frequence')->nullable();
            $table->decimal('montant',10,2);
            $table->timestamps();
            $table->foreignIdFor(\App\Models\Compte::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('revenus');
    }
};
