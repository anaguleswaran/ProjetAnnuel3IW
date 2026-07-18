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
        Schema::create('comptes', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 80);
            $table->text('description')->nullable();
            $table->decimal('taux_remuneration',4,2)->default(0);
            $table->decimal('taux_imposition',4,2)->default(0);
            $table->timestamps();
            $table->foreignIdFor(\App\Models\User::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comptes');
    }
};
