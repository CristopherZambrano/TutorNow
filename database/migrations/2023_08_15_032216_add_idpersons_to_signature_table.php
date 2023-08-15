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
        Schema::table('signature', function (Blueprint $table) {
            $table->unsignedBigInteger('id_person')->default(1); 
            $table->foreign('id_person')->references('id')->on('persons');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('signature', function (Blueprint $table) {
            $table->dropForeign(['id_person']); 
            $table->dropColumn('id_person');
        });
    }
};
