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
        Schema::create('studentList', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_person')->constrained('persons')->onDelete('restrict');
            $table->foreignId('id_class')->constrained('lessons')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentList');
    }
};
