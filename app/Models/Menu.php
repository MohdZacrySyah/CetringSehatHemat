<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    // Izinkan kolom ini diisi oleh Controller
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'is_paket_hemat', // Penting agar checkbox berfungsi
    ];

    protected $casts = [
        'is_paket_hemat' => 'boolean',
    ];
}