@extends('layouts.app')
@section('title', 'Penilaian dan Ulasan')

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #a8b87c 0%, #879b55 100%);
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .rating-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 15px 2vw 80px 2vw;
    }
    .rating-header {
        background-color: #879b55;
        color: #fff;
        padding: 14px 0;
        font-weight: 700;
        font-size: 1.15rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        margin-top: 22px;
        border-radius: 9px;
    }
    .rating-back-btn {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.45rem;
        color: #fff;
        border: none;
        background: none;
        cursor: pointer;
    }
    
    .review-card {
        background: #e0e9cf;
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        position: relative;
    }
    .review-header {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .review-avatar {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #c2d5a0;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        flex-shrink: 0;
    }
    .review-avatar i {
        font-size: 1.3rem;
        color: #4A572A;
    }
    .review-info {
        flex: 1;
    }
    .review-name {
        font-size: 1rem;
        font-weight: 700;
        color: #2e3c1d;
        margin: 0 0 2px 0;
    }
    .review-menu {
        font-size: 0.88rem;
        color: #555;
        margin: 0 0 6px 0;
    }
    .review-stars {
        display: flex;
        gap: 2px;
    }
    .review-stars i {
        color: #ffc107;
        font-size: 0.9rem;
    }
    .review-stars i.empty {
        color: #d0d0d0;
    }
    .review-text {
        font-size: 0.92rem;
        color: #333;
        line-height: 1.6;
        font-style: italic;
        margin-top: 12px;
    }
    .review-date {
        position: absolute;
        top: 18px;
        right: 20px;
        font-size: 0.8rem;
        color: #888;
    }
    
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }
    .empty-state i {
        font-size: 3.5rem;
        color: #c2d5a0;
        margin-bottom: 15px;
    }
    
    @media (max-width: 660px) {
        .rating-container {padding-left: 3vw; padding-right: 3vw;}
    }
</style>
@endpush

@section('content')
<div class="rating-header">
    <button class="rating-back-btn" onclick="window.history.back()">
        <i class="fa-solid fa-arrow-left"></i>
    </button>
    Penilaian dan Ulasan
</div>

<div class="rating-container">
    @if($reviews->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-star"></i>
            <p>Belum ada review</p>
        </div>
    @else
        @foreach($reviews as $review)
        <div class="review-card">
            <div class="review-date">
                {{ $review->reviewed_at->diffForHumans() }}
            </div>
            
            <div class="review-header">
                <div class="review-avatar">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="review-info">
                    <h3 class="review-name">{{ $review->customer_name }}</h3>
                    <p class="review-menu">Pesanan : {{ $review->menu_name }}</p>
                    <div class="review-stars">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $review->rating)
                                <i class="fa-solid fa-star"></i>
                            @else
                                <i class="fa-solid fa-star empty"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            
            <p class="review-text">{{ $review->review }}</p>
        </div>
        @endforeach
    @endif
</div>
@endsection
