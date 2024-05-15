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
            $table->unsignedBigInteger('id_message');
            $table->unsignedBigInteger("id_incidence")->nullable();
            $table->unsignedBigInteger("id_department")->nullable();
            $table->unsignedBigInteger("id_aula")->nullable();
            $table->string("description")->nullable();
            $table->dateTime('fecha_creacion')->nullable();
            $table->unsignedBigInteger("user")->nullable();
            $table->enum('estado', ['abierta', 'en proceso', 'solucionado']);
            $table->foreign("id_incidence")->references("id")->on("incidences");
            $table->foreign("id_department")->references("id")->on("department");
            $table->foreign("id_aula")->references("id")->on("aula");
            $table->foreign("user")->references("id")->on("users");

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
