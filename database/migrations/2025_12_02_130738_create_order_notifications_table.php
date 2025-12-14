<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title'); // "Pesanan Selesai"
            $table->string('menu_name');
            $table->text('menu_image');
            $table->integer('quantity');
            $table->integer('total_price');
            $table->date('order_date');
            $table->date('delivery_date');
            $table->text('address');
            $table->string('phone');
            $table->string('status')->default('completed'); // completed, cancelled, pending
            $table->text('description')->nullable();
            $table->date('rating_deadline')->nullable(); // Batas waktu beri rating
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_notifications');
    }
};
