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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->string("title_en");
            $table->string("title_ar");
            $table->string('image')->nullable();
            $table->integer('status')->default(1);
            $table->foreignId('catgory_id')->constrained()->cascadeOnDelete();
            $table->double('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
