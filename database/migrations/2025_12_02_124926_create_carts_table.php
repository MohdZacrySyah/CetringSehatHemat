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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->string('name');
            $table->text('image');
            $table->integer('price');
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            // Composite index untuk mencegah duplikasi item
            $table->unique(['user_id', 'menu_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
};
