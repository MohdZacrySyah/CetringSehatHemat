@extends('layouts.app')
@section('title', 'Pembayaran')

@push('styles')
<style>
    body {
        background: linear-gradient(180deg, #8B9D5E 0%, #B4C588 100%);
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .payment-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 0 15px 90px 15px;
    }
    .payment-header {
        background-color: #879b55;
        color: #fff;
        padding: 15px 0;
        text-align: center;
        font-weight: 700;
        font-size: 1.1rem;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    .payment-card {
        background: #e8f0d8;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
    }
    .payment-method-logo {
        text-align: center;
        margin-bottom: 15px;
    }
    .payment-method-logo img {
        height: 50px;
    }
    .payment-info {
        background: #fff;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }
    .info-label {
        color: #555;
        font-weight: 500;
    }
    .info-value {
        color: #2d3a1a;
        font-weight: 600;
        text-align: right;
    }
    .qr-section {
        text-align: center;
        margin: 20px 0;
    }
    .qr-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3a1a;
        margin-bottom: 15px;
    }
    .qr-code {
        background: #fff;
        display: inline-block;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .qr-code img {
        width: 200px;
        height: 200px;
    }
    .qr-instruction {
        margin-top: 15px;
        font-size: 0.9rem;
        color: #555;
    }
    .btn-group {
        display: flex;
        gap: 10px;
    }
    .btn-action {
        flex: 1;
        padding: 14px;
        border: none;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-check-qr {
        background: #f5f5f5;
        color: #333;
    }
    .btn-check-qr:hover {
        background: #e0e0e0;
    }
    .btn-confirm {
        background: #6B8E23;
        color: #fff;
    }
    .btn-confirm:hover {
        background: #556d1c;
    }
</style>
@endpush

@section('content')
<div class="payment-container">
    <div class="payment-header">
        Pembayaran
    </div>

    <div class="payment-card">
        <div class="payment-method-logo">
            @if($order->payment_method == 'dana')
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/512px-Logo_dana_blue.svg.png" alt="Dana">
            @elseif($order->payment_method == 'gopay')
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" alt="Gopay">
            @elseif($order->payment_method == 'linkaja')
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/LinkAja.svg/512px-LinkAja.svg.png" alt="LinkAja">
            @elseif($order->payment_method == 'ovo')
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_ovo_purple.svg/512px-Logo_ovo_purple.svg.png" alt="OVO">
            @elseif($order->payment_method == 'qris')
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/QRIS_logo.svg/512px-QRIS_logo.svg.png" alt="QRIS">
            @endif
        </div>

        <div class="payment-info">
            <div class="info-row">
                <span class="info-label">Penerima</span>
                <span class="info-value">CATERING SEHAT HEMAT</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nomor Pesanan</span>
                <span class="info-value">{{ $order->order_number }}</span>
            </div>
            <div class="info-row" style="font-size: 1.05rem; margin-top: 10px; padding-top: 10px; border-top: 1px solid #e0e0e0;">
                <span class="info-label" style="font-weight: 700;">Total bayar</span>
                <span class="info-value" style="color: #6B8E23; font-weight: 700; font-size: 1.15rem;">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</span>
            </div>
        </div>

        @if($order->payment_method == 'qris')
        <div class="qr-section">
            <div class="qr-title">QR CODE</div>
            <div class="qr-code">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode('Order:'.$order->order_number.'|Amount:'.$order->total_bayar) }}" alt="QR Code">
            </div>
            <p class="qr-instruction">Scan QR code untuk melakukan pembayaran</p>
        </div>
        @else
        <div class="qr-section">
            <div class="qr-title">Kode Pembayaran</div>
            <div class="qr-code">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode('Order:'.$order->order_number.'|Amount:'.$order->total_bayar.'|Method:'.strtoupper($order->payment_method)) }}" alt="Payment Code">
            </div>
            <p class="qr-instruction">Buka aplikasi {{ strtoupper($order->payment_method) }} dan scan kode di atas</p>
        </div>
        @endif
    </div>

    <div class="btn-group">
        <button class="btn-action btn-check-qr" onclick="alert('Fitur cek kode QR')">
            Untuk Kode QR
        </button>
        <form action="{{ route('order.payment.confirm', $order->id) }}" method="POST" style="flex: 1;">
            @csrf
            <button type="submit" class="btn-action btn-confirm" style="width: 100%;">
                Saya Sudah Pembayaran
            </button>
        </form>
    </div>
</div>
@endsection
