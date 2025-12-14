<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'menu_name',
        'menu_image',
        'quantity',
        'total_price',
        'order_date',
        'delivery_date',
        'address',
        'phone',
        'status',
        'description',
        'rating_deadline',
        'is_read',
    ];

    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
        'rating_deadline' => 'date',
        'is_read' => 'boolean',
        'quantity' => 'integer',
        'total_price' => 'integer',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Hitung jumlah notifikasi belum dibaca
    public function scopeUnread($query, $userId = null)
    {
        $userId = $userId ?? auth()->id();
        return $query->where('user_id', $userId)->where('is_read', false)->count();
    }

    // Ambil notifikasi terbaru
    public function scopeLatest($query, $userId = null)
    {
        $userId = $userId ?? auth()->id();
        return $query->where('user_id', $userId)->orderBy('created_at', 'desc');
    }

    // Format tanggal untuk tampilan
    public function getFormattedOrderDateAttribute()
    {
        return $this->order_date->format('d/m/Y');
    }

    public function getFormattedDeliveryDateAttribute()
    {
        return $this->delivery_date->format('d/m/Y');
    }

    public function getFormattedRatingDeadlineAttribute()
    {
        return $this->rating_deadline ? $this->rating_deadline->format('d.m.Y') : null;
    }
}
