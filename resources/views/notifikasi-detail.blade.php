@extends('layouts.app')
@section('title', 'Detail Pesanan')

@push('styles')
<style>
    body {
        background: #bfc993;
    }
    .detail-section {
        max-width: 700px;
        margin: 0 auto;
        padding: 15px 0 80px 0;
    }
    .detail-header {
        background-color: #879b55;
        color: #fff;
        padding: 15px 0;
        border-radius: 9px;
        font-weight: bold;
        font-size: 1.18rem;
        margin-bottom: 25px;
        margin-top: 22px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.07);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .detail-back-btn {
        position: absolute;
        left: 19px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.43rem;
        color: #fff;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
        z-index: 2;
    }
    .detail-box {
        background: #e0e9cf;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 3px 12px rgba(0,0,0,0.08);
    }
    .detail-title {
        text-align: center;
        font-size: 1.15rem;
        font-weight: 700;
        color: #3d4621;
        margin-bottom: 25px;
    }
    .detail-img-wrapper {
        text-align: center;
        margin-bottom: 25px;
    }
    .detail-img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 15px;
        border: 3px solid #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .detail-menu-name {
        text-align: center;
        font-size: 1.05rem;
        font-weight: 600;
        color: #3d4621;
        margin-top: 12px;
    }
    .detail-row {
        background: #f4f8e8;
        border-radius: 10px;
        padding: 12px 18px;
        margin-bottom: 12px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 1px 4px rgba(0,0,0,0.04);
    }
    .detail-label {
        font-weight: 600;
        color: #3d4621;
        font-size: 0.98rem;
    }
    .detail-value {
        color: #556B2F;
        font-size: 0.98rem;
    }
    @media (max-width: 660px){
        .detail-section {padding-left: 3vw; padding-right: 3vw;}
    }
</style>
@endpush

@section('content')
<div class="detail-header">
    <button class="detail-back-btn" onclick="window.history.back()" type="button">
        <i class="fa-solid fa-arrow-left"></i>
    </button>
    Detail Pesanan
</div>

<div class="detail-section">
    <div class="detail-box">
        <div class="detail-title">{{ $notification->title }}</div>
        
        <div class="detail-img-wrapper">
            <img src="{{ asset($notification->menu_image) }}" class="detail-img" alt="{{ $notification->menu_name }}">
            <div class="detail-menu-name">{{ $notification->menu_name }}</div>
        </div>

        <div class="detail-row">
            <span class="detail-label">{{ $notification->quantity }} Porsi</span>
            <span class="detail-value">{{ $notification->menu_name }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Total</span>
            <span class="detail-value">Rp.{{ number_format($notification->total_price, 0, ',', '.') }} x{{ $notification->quantity }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Tanggal Pesan</span>
            <span class="detail-value">{{ $notification->formatted_order_date }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Tanggal Pengiriman</span>
            <span class="detail-value">{{ $notification->formatted_delivery_date }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">Alamat</span>
            <span class="detail-value">{{ $notification->address }}</span>
        </div>

        <div class="detail-row">
            <span class="detail-label">No.Telpon</span>
            <span class="detail-value">{{ $notification->phone }}</span>
        </div>
    </div>
</div>
@endsection
