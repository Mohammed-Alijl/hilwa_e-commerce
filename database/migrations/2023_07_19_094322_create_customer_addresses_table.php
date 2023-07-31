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
        Schema::create('customer_addresses', function (Blueprint $table) {
            $table->id();
            $table->double('latitude');
            $table->double('longitude');
            $table->string('address_one');
            $table->string('address_two')->nullable();
            $table->string('street');
            $table->string('district');
            $table->foreignId('address_type_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('status');
            $table->boolean('isDefault');
            $table->enum('use_for',['delivery','billing']);
            $table->integer('postal_code');
            $table->foreignId('customer_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('city_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_addresses');
    }
};
