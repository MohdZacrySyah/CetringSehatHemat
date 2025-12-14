<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('menu_name');
            $table->text('menu_image');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('total_price');
            $table->string('status')->default('cancelled'); // cancelled, completed, failed
            $table->text('cancel_reason')->nullable();
            $table->string('ordered_by')->default('Pembeli');
            $table->timestamp('ordered_at')->nullable();
            $table->text('address');
            $table->string('payment_method')->default('Belum Bayar');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_archives');
    }
};
