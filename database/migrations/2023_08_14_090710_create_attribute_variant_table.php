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
        Schema::create('attribute_variant', function (Blueprint $table) {
            $table->foreignId('attribute_id')->constrained();
            $table->foreignId('variant_id')->constrained()->cascadeOnDelete();
            $table->foreignId('attribute_value_id')->constrained();
            $table->primary(['attribute_id','variant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attribute_variant');
    }
};
