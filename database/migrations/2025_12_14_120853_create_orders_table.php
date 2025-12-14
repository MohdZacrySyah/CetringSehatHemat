<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('subtotal');
            $table->integer('biaya_pengiriman')->default(0);
            $table->integer('biaya_aplikasi')->default(1000);
            $table->integer('total_bayar');
            $table->string('payment_method')->nullable(); // dana, gopay, linkaja, ovo, qris
            $table->enum('status', ['pending', 'paid', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->text('customer_notes')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->string('menu_name');
            $table->integer('price');
            $table->integer('quantity');
            $table->integer('subtotal');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};
