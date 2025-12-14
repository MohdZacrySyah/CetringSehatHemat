<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name'); // Nama customer
            $table->string('menu_name'); // Nama menu yang dipesan
            $table->integer('rating')->default(5); // Rating 1-5
            $table->text('review'); // Isi review/ulasan
            $table->timestamp('reviewed_at')->nullable(); // Tanggal review
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
