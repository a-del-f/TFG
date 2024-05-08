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
        Schema::create("messages", function (Blueprint $table){
            $table->id();
            $table->bigInteger("id_incidence")->nullable()->unsigned();
            $table->bigInteger("id_department")->nullable()->unsigned();
            $table->bigInteger("id_aula")->nullable()->unsigned();
            $table->string("description")->nullable();
            $table->dateTime('fecha_creacion')->nullable();
            $table->string("user")->nullable();
            $table->enum('estado', ['en espera', 'solucionando', 'solucionado'])->default('en espera');
            $table->foreign("id_incidence")->references("id")->on("incidences");
            $table->foreign("id_department")->references("id")->on("department");
            $table->foreign("id_aula")->references("id")->on("aula");

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');

    }
};
