<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::latest()->get();
        $averageRating = Review::averageRating();
        $totalReviews = Review::totalReviews();

        return view('rating', compact('reviews', 'averageRating', 'totalReviews'));
    }
}
