@extends('layouts.app')
@section('title', 'Arsipan Pesanan Anda')

@push('styles')
<style>
    body {
        background: #8ea85f;
    }
    .arsip-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 15px 0 80px 0;
    }
    .arsip-header {
        background-color: #879b55;
        color: #fff;
        padding: 12px 0;
        border-radius: 0;
        font-weight: 600;
        font-size: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }
    .arsip-back-btn {
        position: absolute;
        left: 15px;
        font-size: 1.3rem;
        color: #fff;
        border: none;
        background: none;
        cursor: pointer;
    }

    .arsip-actions {
        text-align: right;
        margin-bottom: 15px;
    }
    .clear-all-btn {
        background: #f8d7da;
        color: #721c24;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
        font-weight: 600;
    }
    .clear-all-btn:hover {
        background: #f5c6cb;
    }

    .arsip-card {
        background: #e5f0c9;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 16px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        display: flex;
        gap: 14px;
        align-items: flex-start;
        position: relative;
    }
    .arsip-badge {
        background: #fff;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 700;
        color: #333;
        display: inline-block;
        margin-bottom: 8px;
    }
    .arsip-badge i {
        color: #d9534f;
        margin-right: 4px;
    }
    .arsip-img {
        width: 70px;
        height: 70px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
    }
    .arsip-main {
        flex: 1;
    }
    .arsip-title {
        font-size: 0.95rem;
        font-weight: 700;
        color: #2e3c1d;
        margin: 0 0 4px 0;
    }
    .arsip-reason {
        font-size: 0.8rem;
        color: #31401f;
        margin: 0 0 8px 0;
    }
    .arsip-total {
        font-size: 0.82rem;
        color: #555;
        margin-bottom: 10px;
    }
    .arsip-actions-buttons {
        display: flex;
        gap: 10px;
    }
    .arsip-btn {
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.8rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }
    .arsip-btn-outline {
        background: #fff;
        color: #333;
        border: 1px solid #bbb;
    }
    .arsip-btn-outline:hover {
        background: #f5f5f5;
    }
    .arsip-btn-red {
        background: #f8d7da;
        color: #721c24;
    }
    .arsip-btn-red:hover {
        background: #f5c6cb;
    }
    .arsip-delete {
        position: absolute;
        top: 14px;
        right: 14px;
        color: #ab3d36;
        font-size: 1rem;
        cursor: pointer;
        background: none;
        border: none;
    }
    .arsip-empty {
        text-align: center;
        color: #666;
        padding: 40px 20px;
    }
    .arsip-empty i {
        font-size: 3rem;
        color: #bbb;
        margin-bottom: 15px;
    }

    @media (max-width:660px){
        .arsip-wrapper {padding-left: 2vw; padding-right: 2vw;}
    }
</style>
@endpush

@section('content')
<div class="arsip-wrapper">
    <div class="arsip-header">
        <button class="arsip-back-btn" onclick="window.history.back()">
            <i class="fa-solid fa-arrow-left"></i>
        </button>
        Arsipan Pesanan Anda
    </div>

    @if($canceledOrders->isEmpty())
        <div class="arsip-empty">
            <i class="fa-solid fa-archive"></i>
            <p>Belum ada arsip pesanan</p>
        </div>
    @else
        <div class="arsip-actions">
            <form action="{{ route('arsip.clear-all') }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus semua arsip pesanan?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="clear-all-btn">
                    <i class="fa-solid fa-trash"></i> Hapus Semua Arsip
                </button>
            </form>
        </div>

        @foreach($canceledOrders as $order)
        <div class="arsip-card">
            <img src="{{ asset($order->menu_image) }}" alt="{{ $order->menu_name }}" class="arsip-img">
            <div class="arsip-main">
                <div class="arsip-badge">
                    <i class="fa-solid fa-circle-xmark"></i> Pesanan Cancel
                </div>
                <h3 class="arsip-title">{{ $order->menu_name }}</h3>
                <p class="arsip-reason">{{ $order->cancel_reason }}</p>
                <div class="arsip-total">
                    <strong>Total produk:</strong> Harga Rp.{{ number_format($order->price, 0, ',', '.') }}
                </div>
                <div class="arsip-actions-buttons">
                    <a href="{{ route('arsip.detail', $order->id) }}" class="arsip-btn arsip-btn-outline">
                        Rincian Pembatalan
                    </a>
                    <a href="{{ route('arsip.buy-again', $order->id) }}" class="arsip-btn arsip-btn-red">
                        Beli lagi
                    </a>
                </div>
            </div>
            <form action="{{ route('arsip.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Hapus arsip ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="arsip-delete">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
        @endforeach
    @endif
</div>
@endsection
