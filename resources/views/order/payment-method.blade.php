@extends('layouts.app')
@section('title', 'Pilih Metode Pembayaran')

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
        background-color: #f8f9fa;
        color: #333;
        padding: 15px;
        text-align: center;
        font-weight: 700;
        font-size: 1.1rem;
        border-radius: 10px 10px 0 0;
        border-bottom: 2px solid #e0e0e0;
    }
    .cart-summary {
        background: #fff;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .cart-item {
        display: flex;
        gap: 12px;
        margin-bottom: 10px;
    }
    .cart-item-img {
        width: 60px;
        height: 60px;
        border-radius: 8px;
        object-fit: cover;
    }
    .cart-item-info {
        flex: 1;
    }
    .cart-item-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 3px;
    }
    .cart-item-price {
        color: #6B8E23;
        font-weight: 600;
    }
    .info-text {
        font-size: 0.9rem;
        color: #666;
        margin-bottom: 15px;
        padding: 0 15px;
    }
    .payment-methods {
        background: #fff;
        border-radius: 10px;
        padding: 20px 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    .method-title {
        font-size: 1rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 15px;
    }
    .method-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        margin-bottom: 10px;
        cursor: pointer;
        transition: all 0.3s;
    }
    .method-option:hover {
        border-color: #6B8E23;
        background: #f9fdf4;
    }
    .method-option.selected {
        border-color: #6B8E23;
        background: #f0f8e6;
    }
    .method-option input[type="radio"] {
        width: 20px;
        height: 20px;
        accent-color: #6B8E23;
    }
    .method-logo {
        height: 30px;
        object-fit: contain;
    }
    .price-summary {
        background: #e8f0d8;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 15px;
    }
    .price-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    .price-label {
        color: #555;
    }
    .price-value {
        font-weight: 600;
        color: #2d3a1a;
    }
    .price-total {
        font-size: 1.1rem;
        font-weight: 700;
        color: #6B8E23;
        padding-top: 10px;
        border-top: 2px solid #bcd19a;
        margin-top: 5px;
    }
    .btn-pay {
        width: 100%;
        padding: 15px;
        background: #6B8E23;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }
    .btn-pay:hover {
        background: #556d1c;
    }
    .btn-pay:disabled {
        background: #ccc;
        cursor: not-allowed;
    }
</style>
@endpush

@section('content')
<div class="payment-container">
    <div class="payment-header">
        Beli sekarang
    </div>

    <div class="cart-summary">
        @foreach($order->items as $item)
        <div class="cart-item">
            <img src="{{ asset('storage/' . $item->menu->image) }}" alt="{{ $item->menu_name }}" class="cart-item-img">
            <div class="cart-item-info">
                <div class="cart-item-name">{{ $item->menu_name }}</div>
                <div class="cart-item-price">Rp {{ number_format($item->price, 0, ',', '.') }} x {{ $item->quantity }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <p class="info-text">Pilih metode untuk menyelesaikan pembayaran</p>

    <form action="{{ route('order.payment.select', $order->id) }}" method="POST" id="paymentForm">
        @csrf
        <div class="payment-methods">
            <div class="method-title">Metode</div>
            
            <label class="method-option" onclick="selectMethod(this, 'dana')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/72/Logo_dana_blue.svg/512px-Logo_dana_blue.svg.png" alt="Dana" class="method-logo">
                <input type="radio" name="payment_method" value="dana" required>
            </label>

            <label class="method-option" onclick="selectMethod(this, 'gopay')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg" alt="Gopay" class="method-logo">
                <input type="radio" name="payment_method" value="gopay" required>
            </label>

            <label class="method-option" onclick="selectMethod(this, 'linkaja')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/85/LinkAja.svg/512px-LinkAja.svg.png" alt="LinkAja" class="method-logo">
                <input type="radio" name="payment_method" value="linkaja" required>
            </label>

            <label class="method-option" onclick="selectMethod(this, 'ovo')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/eb/Logo_ovo_purple.svg/512px-Logo_ovo_purple.svg.png" alt="OVO" class="method-logo">
                <input type="radio" name="payment_method" value="ovo" required>
            </label>

            <label class="method-option" onclick="selectMethod(this, 'qris')">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/QRIS_logo.svg/512px-QRIS_logo.svg.png" alt="QRIS" class="method-logo">
                <input type="radio" name="payment_method" value="qris" required>
            </label>
        </div>

        <div class="price-summary">
            <div class="price-row">
                <span class="price-label">Harga total produk</span>
                <span class="price-value">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
            </div>
            <div class="price-row">
                <span class="price-label">Ongkir</span>
                <span class="price-value">Rp {{ number_format($order->biaya_pengiriman, 0, ',', '.') }}</span>
            </div>
            <div class="price-row">
                <span class="price-label">Biaya aplikasi</span>
                <span class="price-value">Rp {{ number_format($order->biaya_aplikasi, 0, ',', '.') }}</span>
            </div>
            <div class="price-row price-total">
                <span class="price-label">Total bayar</span>
                <span class="price-value">Rp {{ number_format($order->total_bayar, 0, ',', '.') }}</span>
            </div>
        </div>

        <button type="submit" class="btn-pay" id="btnPay" disabled>
            Bayar
        </button>
    </form>
</div>

@push('scripts')
<script>
    function selectMethod(element, method) {
        // Remove selected class from all options
        document.querySelectorAll('.method-option').forEach(opt => {
            opt.classList.remove('selected');
        });
        
        // Add selected class to clicked option
        element.classList.add('selected');
        
        // Enable button
        document.getElementById('btnPay').disabled = false;
    }
</script>
@endpush
@endsection
