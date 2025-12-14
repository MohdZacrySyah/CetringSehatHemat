@extends('layouts.app')
@section('title', 'Pesan Kembali')

@push('styles')
<style>
    body {
        background: #8ea85f;
    }
    .buy-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 15px 0 80px 0;
    }
    .buy-header {
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
    .buy-back-btn {
        position: absolute;
        left: 15px;
        font-size: 1.3rem;
        color: #fff;
        border: none;
        background: none;
        cursor: pointer;
    }

    .buy-card {
        background: #e5f0c9;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        margin-bottom: 16px;
    }
    .buy-title {
        font-size: 1rem;
        font-weight: 700;
        color: #c89c00;
        margin: 0 0 12px 0;
    }
    .buy-content {
        display: flex;
        gap: 14px;
        margin-bottom: 14px;
    }
    .buy-img {
        width: 70px;
        height: 70px;
        border-radius: 10px;
        object-fit: cover;
    }
    .buy-info {
        flex: 1;
    }
    .buy-name {
        font-size: 0.92rem;
        font-weight: 700;
        color: #2e3c1d;
        margin: 0 0 4px 0;
    }
    .buy-total {
        font-size: 0.82rem;
        color: #555;
    }
    .buy-summary {
        background: #f3fbdf;
        border-radius: 8px;
        padding: 10px 14px;
        margin-top: 12px;
    }
    .buy-row {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 6px;
        color: #333;
    }
    .buy-row strong {
        font-weight: 600;
    }

    .buy-item-box {
        background: #a9ba7f;
        border-radius: 8px;
        padding: 10px 14px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.88rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 16px;
    }
    .buy-final {
        background: #e5f0c9;
        border-radius: 8px;
        padding: 12px 16px;
        text-align: center;
        font-size: 0.92rem;
        font-weight: 700;
        color: #2e3c1d;
        border-top: 2px solid #333;
        margin-top: 16px;
    }
    .buy-btn-pay {
        background: #fff;
        padding: 10px 24px;
        border-radius: 8px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #333;
        border: none;
        cursor: pointer;
        float: right;
        margin-top: 16px;
    }

    @media (max-width:660px){
        .buy-wrapper {padding-left: 2vw; padding-right: 2vw;}
    }
</style>
@endpush

@section('content')
<div class="buy-wrapper">
    <div class="buy-header">
        <button class="buy-back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
    </div>

    <div class="buy-card">
        <h3 class="buy-title">Pesan Kembali</h3>
        
        <div class="buy-content">
            <img src="{{ asset($order->menu_image) }}" alt="{{ $order->menu_name }}" class="buy-img">
            <div class="buy-info">
                <h4 class="buy-name">{{ $order->menu_name }}</h4>
                <div class="buy-total">
                    <strong>Total produk:</strong> Harga Rp.{{ number_format($order->price, 0, ',', '.') }}
                </div>
            </div>
        </div>

        <div class="buy-summary">
            <div class="buy-row">
                <span>{{ $order->menu_name }}</span>
                <span></span>
            </div>
            <div class="buy-row">
                <span>{{ $order->quantity }} Porsi</span>
                <span>Total:</span>
            </div>
            <div class="buy-row">
                <span></span>
                <strong>{{ $order->menu_name }}</strong>
            </div>
            <div class="buy-row">
                <span></span>
                <strong>Harga Rp.{{ number_format($order->price, 0, ',', '.') }} × {{ $order->quantity }}</strong>
            </div>
        </div>
    </div>

    <div class="buy-item-box">
        <span>Item</span>
        <span>{{ $order->quantity }}</span>
        <span>Harga Rp.{{ number_format($order->total_price, 0, ',', '.') }}</span>
    </div>

    <div class="buy-final">
        <div style="border-top:2px solid #333;padding-top:8px;">
            <strong>Total Harga Pesanan</strong><br>
            Rp.{{ number_format($order->total_price, 0, ',', '.') }}
        </div>
    </div>

    <button class="buy-btn-pay">LANJUT PEMBAYARAN</button>
</div>
@endsection
