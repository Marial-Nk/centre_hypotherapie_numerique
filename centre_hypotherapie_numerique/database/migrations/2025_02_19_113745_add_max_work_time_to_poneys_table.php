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
        Schema::table('poneys', function (Blueprint $table) {
            $table->integer('max_work_time')->default(10); // Ajout avec valeur par défaut
        });
    }

    public function down()
    {
        Schema::table('poneys', function (Blueprint $table) {
            $table->dropColumn('max_work_time');
        });
    }

};
