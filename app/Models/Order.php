<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id',
        'subtotal',
        'biaya_pengiriman',
        'biaya_aplikasi',
        'total_bayar',
        'payment_method',
        'status',
        'customer_notes',
        'paid_at',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
    ];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke order items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Generate order number otomatis
    public static function generateOrderNumber()
    {
        return 'ORD' . date('Ymd') . rand(1000, 9999);
    }
}
