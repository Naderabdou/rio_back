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
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('sub_title_ar')->nullable();
            $table->string('sub_title_en')->nullable();
            $table->string('slug')->unique();
            $table->text('desc_ar');
            $table->text('desc_en');
            $table->string('image');
            $table->string('price');
            $table->string('discount')->nullable();
            $table->boolean('is_active')->default(0);

            $table->string('label_ar')->nullable();
            $table->string('label_en')->nullable();
            $table->string('label_color')->nullable();
            $table->string('price_after_discount')->nullable();
            $table->string('stock');
            $table->boolean('has_offer')->default(false);
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');



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
