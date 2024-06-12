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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number'); //
            $table->enum('status', ['pending', 'pocessing','shipped', 'driving', 'completed', 'declined'])->default('pending');
            $table->enum('type', ['order', 'cart'])->default('order'); //نوع الطلب
            $table->integer('total_price'); //السعر الكلي
            $table->string('tax')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_value')->nullable();
            $table->string('discount')->nullable();
            $table->string('price_befor_discount')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            // $table->foreignId('user_id')->constrained('users')->onDelete('set null'); //المستخدم الذي قام بالطلب
            $table->foreignId('address_id')->nullable()->constrained('addresses')->onDelete('set null'); //العنوان
         //   $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null'); //المستخدم الذي قام بالطلب
         $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null'); //العنوان
            $table->string('payment_method');

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->timestamp('processing_at')->nullable();
            $table->timestamp('shipped_at')->nullable();
            $table->timestamp('driving_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            //العنوان
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
