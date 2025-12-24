<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke User (Pembeli)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            // Relasi ke Menu (Makanan)
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            
            // Hanya simpan jumlah, data lain ambil dari relasi menu_id
            $table->integer('quantity')->default(1);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};