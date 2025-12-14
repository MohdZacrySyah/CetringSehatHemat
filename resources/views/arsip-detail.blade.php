@extends('layouts.app')
@section('title', 'Rincian Pembatalan')

@push('styles')
<style>
    body {
        background: #8ea85f;
    }
    .detail-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 15px 0 80px 0;
    }
    .detail-header {
        background-color: #879b55;
        color: #fff;
        padding: 12px 0;
        font-weight: 600;
        font-size: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    .detail-back-btn {
        position: absolute;
        left: 15px;
        font-size: 1.3rem;
        color: #fff;
        border: none;
        background: none;
        cursor: pointer;
    }

    .detail-card {
        background: #e5f0c9;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        position: relative;
    }
    .detail-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .detail-badge {
        background: #fff;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #d9534f;
    }
    .detail-close-btn {
        position: absolute;
        top: 16px;
        right: 16px;
        font-size: 1.5rem;
        color: #d9534f;
        cursor: pointer;
        background: #fff;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #d9534f;
    }
    .detail-content {
        display: flex;
        gap: 16px;
        margin-bottom: 16px;
    }
    .detail-img {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        object-fit: cover;
    }
    .detail-info {
        flex: 1;
    }
    .detail-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: #2e3c1d;
        margin: 0 0 4px 0;
    }
    .detail-total {
        font-size: 0.85rem;
        color: #555;
        margin-bottom: 12px;
    }
    .detail-row {
        font-size: 0.82rem;
        margin-bottom: 6px;
        color: #333;
    }
    .detail-row strong {
        min-width: 130px;
        display: inline-block;
    }
    .detail-btn-home {
        background: #879b55;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #fff;
        border: none;
        cursor: pointer;
        float: right;
        margin-top: 16px;
        text-decoration: none;
        display: inline-block;
    }
    .detail-btn-home:hover {
        background: #556b2f;
    }

    @media (max-width:660px){
        .detail-wrapper {padding-left: 2vw; padding-right: 2vw;}
    }
</style>
@endpush

@section('content')
<div class="detail-wrapper">
    <div class="detail-header">
        <button class="detail-back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        Rincian Pembatalan
    </div>

    <div class="detail-card">
        <div class="detail-card-header">
            <div class="detail-badge">Pembatalan Berhasil</div>
            <div class="detail-close-btn" onclick="window.history.back()">
                <i class="fa-solid fa-xmark"></i>
            </div>
        </div>

        <p style="font-size:0.78rem;color:#555;margin:0 0 8px 0;">pada {{ $order->formatted_ordered_at }}</p>

        <div class="detail-content">
            <img src="{{ asset($order->menu_image) }}" alt="{{ $order->menu_name }}" class="detail-img">
            <div class="detail-info">
                <h3 class="detail-name">{{ $order->menu_name }}</h3>
                <div class="detail-total">
                    <strong>Total produk:</strong> Harga Rp.{{ number_format($order->price, 0, ',', '.') }}
                </div>

                <div class="detail-row">
                    <strong>Diminata Oleh:</strong> {{ $order->ordered_by }}
                </div>
                <div class="detail-row">
                    <strong>Dipesan Pada:</strong> {{ $order->formatted_ordered_at }}
                </div>
                <div class="detail-row">
                    <strong>Alasan:</strong> {{ $order->address }}
                </div>
                <div class="detail-row">
                    <strong>Metode Pembayaran:</strong> {{ $order->payment_method }}
                </div>
            </div>
        </div>

        <a href="{{ route('dashboard') }}" class="detail-btn-home">
            <i class="fa-solid fa-house"></i> KEMBALI KE BERANDA
        </a>
    </div>
</div>
@endsection
