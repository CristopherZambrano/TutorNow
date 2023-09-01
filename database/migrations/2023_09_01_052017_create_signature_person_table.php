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
        Schema::create('signature_person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_person')->constrained('persons')->onDelete('restrict');
            $table->foreignId('id_signature')->constrained('signature')->onDelete('restrict');
            $table->text('code');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('signature_person');
    }
};
