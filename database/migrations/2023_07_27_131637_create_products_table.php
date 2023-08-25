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
            $table->string('name');
            $table->longText('description_en');
            $table->longText('description_ar');
            $table->string('sku');
            $table->double('price')->default(0);
            $table->double('special_price')->default(0);
            $table->integer('min_quantity')->default(1);
            $table->integer('max_quantity')->default(1);
            $table->boolean('show_customer_app')->default('1');
            $table->integer('weight_in_points')->default(0);
            $table->foreignId('unit_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->integer('stock_quantity')->default(0);
            $table->enum('stock_status',[0,1,2,3])->default(0);
            $table->boolean('status')->default(1);
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
