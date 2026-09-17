<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('partages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compte_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); // rempli quand accepté
            $table->string('email_invite');
            $table->string('token')->unique();
            $table->string('statut')->default('en_attente'); // en_attente | accepte
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('partages');
    }
};