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
        Schema::create('static_settings', function (Blueprint $table) {
            $table->id();
            $table->boolean('update_open')->default(false);
            $table->boolean('confirm_place_order')->default(false);
            $table->boolean('create_new_order_back_office')->default(false);
            $table->boolean('show_unavailable_offers')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('static_settings');
    }
};
