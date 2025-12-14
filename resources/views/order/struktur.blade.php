@extends('layouts.app')
@section('title', 'Struktur Pembayaran')

@push('styles')
<style>
    body {
        background: linear-gradient(180deg, #8B9D5E 0%, #B4C588 100%);
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    }
    .struktur-container {
        max-width: 600px;
        margin: 20px auto;
        padding: 0 15px 90px 15px;
    }
    .struktur-header {
        background-color: #879b55;
        color: #fff;
        padding: 15px 0;
        text-align: center;
        font-weight: 700;
        font-size: 1.1rem;
        border-radius: 10px;
        margin-bottom: 20px;
        position: relative;
    }
    .back-btn {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #fff;
        font-size: 1.3rem;
        cursor: pointer;
        background: none;
        border: none;
    }
    .success-icon {
        text-align: center;
        margin-bottom: 15px;
    }
    .success-icon i {
        font-size: 3.5rem;
        color: #6B8E23;
    }
    .success-title {
        text-align: center;
        font-size: 1.2rem;
        font-weight: 700;
        color: #2d3a1a;
        margin-bottom: 8px;
    }
    .success-subtitle {
        text-align: center;
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 25px;
    }
    .info-card {
        background: #e8f0d8;
        border-radius: 12px;
        padding: 18px;
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
    .info-value.highlight {
        color: #6B8E23;
        font-size: 1.1rem;
    }
    .divider {
        height: 1px;
        background: #bcd19a;
        margin: 12px 0;
    }
    .total-section {
        background: #d4e1b8;
        border-radius: 12px;
        padding: 15px 18px;
        margin-bottom: 20px;
    }
    .button-group {
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
    .btn-back {
        background: #f5f5f5;
        color: #333;
    }
    .btn-back:hover {
        background: #e0e0e0;
    }
    .btn-continue {
        background: #6B8E23;
        color: #fff;
    }
    .btn-continue:hover {
        background: #556d1c;
    }
</style>
@endpush

@section('content')
<div class="struktur-header">
    <button class="back-btn" onclick="window.history.back()">
        <i class="fa-solid fa-arrow-left"></i>
    </button>
    Struktur Pembayaran
</div>

<div class="struktur-container">
    <div class="success-icon">
        <i class="fa-solid fa-circle-check"></i>
    </div>
    <h2 class="success-title">PEMBAYARAN BERHASIL</h2>
    <p class="success-subtitle">Pesanan berhasil masuk! Silakan lanjut ke tahap pembayaran</p>

    <div class="info-card">
        <div class="info-row">
            <span class="info-label">Amount</span>
            <span class="info-value highlight">Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
        </div>
        <div class="divider"></div>
        <div class="info-row">
            <span class="info-label">Status pembayaran</span>
            <span class="info-value" style="color: #28a745;">Sukses</span>
        </div>
    </div>

    <div class="info-card">
        <div class="info-row">
            <span class="info-label">Ref Number</span>
            <span class="info-value">{{ strtoupper(uniqid()) }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">metode pembayaran</span>
            <span class="info-value">-</span>
        </div>
        <div class="info-row">
            <span class="info-label">tanggal pembayaran</span>
            <span class="info-value">-</span>
        </div>
        <div class="info-row">
            <span class="info-label">Kategori Pembayaran</span>
            <span class="info-value">Catering Sehat Hemat</span>
        </div>
        <div class="info-row">
            <span class="info-label">waktu</span>
            <span class="info-value">{{ now()->format('M d, Y H:i:s') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Pesan</span>
            <span class="info-value">Pesanan berhasil</span>
        </div>
    </div>

    <div class="total-section">
        <div class="info-row">
            <span class="info-label">Harga total produk</span>
            <span class="info-value">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Ongkir (Jika lebih dari 15km)</span>
            <span class="info-value">Rp {{ number_format($biayaPengiriman, 0, ',', '.') }}</span>
        </div>
        <div class="info-row">
            <span class="info-label">Biaya aplikasi</span>
            <span class="info-value">Rp {{ number_format($biayaAplikasi, 0, ',', '.') }}</span>
        </div>
        <div class="divider"></div>
        <div class="info-row">
            <span class="info-label" style="font-size: 1.05rem; font-weight: 700;">Total Bayar</span>
            <span class="info-value" style="font-size: 1.15rem; font-weight: 700; color: #6B8E23;">Rp {{ number_format($totalBayar, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="button-group">
        <button class="btn-action btn-back" onclick="window.history.back()">
            Kembali Ke Keranjang
        </button>
        <form action="{{ route('order.checkout') }}" method="POST" style="flex: 1;">
            @csrf
            <button type="submit" class="btn-action btn-continue" style="width: 100%;">
                Bayar Pesanan
            </button>
        </form>
    </div>
</div>
@endsection
