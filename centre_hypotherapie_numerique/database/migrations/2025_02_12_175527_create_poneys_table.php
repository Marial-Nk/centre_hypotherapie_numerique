<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('poneys', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Vérifie que cette ligne est bien présente
            $table->integer('work_time'); // Vérifie aussi cette ligne
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poneys');
    }
};
