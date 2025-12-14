<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'menu_name',
        'rating',
        'review',
        'reviewed_at',
    ];

    protected $casts = [
        'rating' => 'integer',
        'reviewed_at' => 'datetime',
    ];

    // Ambil semua review terbaru
    public function scopeLatest($query)
    {
        return $query->orderBy('reviewed_at', 'desc');
    }

    // Hitung rata-rata rating
    public static function averageRating()
    {
        return self::avg('rating');
    }

    // Total review
    public static function totalReviews()
    {
        return self::count();
    }
}
