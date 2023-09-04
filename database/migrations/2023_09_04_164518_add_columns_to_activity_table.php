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
        Schema::table('activity', function (Blueprint $table) {
            $table->integer('video')->default(0);
            $table->integer('pdf')->default(0);
            $table->integer('ppt')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('activity', function (Blueprint $table) {
            $table->dropColumn('video');
            $table->dropColumn('pdf');
            $table->dropColumn('ppt');
        });
    }
};
