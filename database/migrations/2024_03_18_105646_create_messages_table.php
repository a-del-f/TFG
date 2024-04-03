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
            $table->integer("id_incidence")->nullable();
            $table->string("description")->nullable();
            $table->boolean("seen")->default(false);
            $table->boolean("solved")->default(false);
            $table->timestamps(false);

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
