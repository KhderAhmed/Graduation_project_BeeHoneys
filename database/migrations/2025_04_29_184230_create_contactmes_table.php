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
        Schema::create('contactmes', function (Blueprint $table) {
            $table->id();
            $table->integer('status')->default(1);
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('email')->unique();
            $table->integer('phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contactmes');
    }
};
