<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('persons',function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->string('user')->unique();
            $table->string('password');
            $table->foreignId('idTipoUser')->constrained('tipo_personas')->onDelete('restrict');
            $table->timestamps();
        });

        DB::table('persons')->insert([
            ['name' => 'Cristopher', 'lastName' => 'Zambrano', 'user' => 'stivzambrano00@gmail.com', 'password' => '123456', 'idTipoUser' => '2'],
            ['name' => 'Diana', 'lastName' => 'Aviles', 'user' => 'davilesc@msuteq.edu.ec', 'password' => '123456', 'idTipoUser' => '2'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('persons');
    }
};
