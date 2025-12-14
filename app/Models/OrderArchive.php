<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OrderArchive extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'menu_name',
        'menu_image',
        'quantity',
        'price',
        'total_price',
        'status',
        'cancel_reason',
        'ordered_by',
        'ordered_at',
        'address',
        'payment_method',
    ];

    protected $casts = [
        'ordered_at' => 'datetime',
        'quantity' => 'integer',
        'price' => 'integer',
        'total_price' => 'integer',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope untuk pesanan yang dibatalkan
    public function scopeCancelled($query, $userId = null)
    {
        $userId = $userId ?? auth()->id();
        return $query->where('user_id', $userId)->where('status', 'cancelled');
    }

    // Scope untuk pesanan yang selesai
    public function scopeCompleted($query, $userId = null)
    {
        $userId = $userId ?? auth()->id();
        return $query->where('user_id', $userId)->where('status', 'completed');
    }

    // Format tanggal pesanan
    public function getFormattedOrderedAtAttribute()
    {
        return $this->ordered_at ? $this->ordered_at->format('d-m-Y H.i') . ' wib' : '-';
    }

    // Hitung total semua arsip
    public function scopeTotalArchived($query, $userId = null)
    {
        $userId = $userId ?? auth()->id();
        return $query->where('user_id', $userId)->count();
    }
}
