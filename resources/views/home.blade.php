@extends('layouts.app')
@section('title', 'Beranda - Catering Sehat Hemat')

{{-- 
    GABUNGKAN DATA UNTUK KEPERLUAN JAVASCRIPT SEARCH 
    (Agar tidak error "Undefined variable $menus") 
--}}
@php
    $menus = $paketHemat->merge($menuReguler);
@endphp

@push('styles')
<style>
    /* --- HEADER & SEARCH --- */
    .main-header {
        background: #879b55;
        border-radius: 15px;
        display: flex;
        align-items: center;
        padding: 15px 22px;
        margin: 25px 3vw 20px;
        box-shadow: 0 4px 12px rgba(135, 155, 85, 0.2);
    }
    .hamburger-menu {
        font-size: 1.6rem;
        color: #fff;
        cursor: pointer;
        margin-right: 18px;
        background: none;
        border: none;
    }
    .main-search-container {
        flex: 1;
        position: relative;
        max-width: 500px;
        margin: 0 auto;
    }
    .search-input {
        width: 100%;
        padding: 12px 45px 12px 20px;
        border: none;
        border-radius: 30px;
        background: rgba(255,255,255,0.9);
        font-size: 1rem;
        color: #3d4621;
        transition: all 0.3s ease;
    }
    .search-input:focus {
        background: white;
        box-shadow: 0 0 0 3px rgba(255,255,255,0.3);
        outline: none;
    }
    .search-icon {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #879b55;
        font-size: 1.2rem;
    }

    /* --- SUGGESTIONS BOX (Pencarian) --- */
    #suggestionsBox {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.11);
        max-height: 300px;
        overflow-y: auto;
        width: 90vw;
        max-width: 500px;
        margin: 0 auto;
        position: absolute; /* Supaya melayang */
        left: 0; right: 0; top: 85px; /* Sesuaikan posisi */
        display: none;
        z-index: 100;
    }
    .suggestion-item {
        padding: 13px 19px;
        cursor: pointer;
        border-bottom: 1px solid #e3e6d8;
        color: #4A572A;
        display: flex;
        align-items: center;
        transition: background 0.2s;
    }
    .suggestion-item:hover { background: #f7fbe7; }

    /* --- SECTION TITLE --- */
    .section-title {
        margin: 30px 3vw 15px;
        font-size: 1.3rem;
        font-weight: 800;
        color: #3d4621;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .section-title span {
        background: #e0e9cf;
        padding: 4px 10px;
        border-radius: 8px;
        font-size: 0.8rem;
        color: #556b2f;
    }

    /* --- GRID SYSTEM --- */
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
        gap: 20px;
        padding: 0 3vw 40px;
    }

    /* --- CARD DESIGN --- */
    .menu-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
        border: 1px solid #f0f0f0;
        display: flex;
        flex-direction: column;
    }
    .menu-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }
    .card-img-wrapper {
        position: relative;
        height: 140px;
        overflow: hidden;
    }
    .card-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .badge-hemat {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #fcd34d;
        color: #78350f;
        font-size: 0.7rem;
        font-weight: 800;
        padding: 4px 8px;
        border-radius: 20px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    .card-body {
        padding: 15px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .menu-name {
        font-weight: 700;
        color: #2d3748;
        font-size: 1rem;
        margin-bottom: 5px;
        line-height: 1.3;
    }
    .menu-desc {
        font-size: 0.8rem;
        color: #718096;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 1;
    }
    .menu-price {
        font-weight: 800;
        color: #879b55;
        font-size: 1.1rem;
        margin-bottom: 12px;
    }
    .btn-add {
        width: 100%;
        background: #879b55;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 8px;
    }
    .btn-add:hover {
        background: #556b2f;
    }

    /* --- TOAST NOTIFICATION --- */
    .toast-show {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        background: #4A572A;
        color: white;
        padding: 12px 25px;
        border-radius: 30px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.2);
        z-index: 9999;
        font-weight: 600;
        animation: slideDown 0.5s ease-out;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    @keyframes slideDown {
        from { top: -50px; opacity: 0; }
        to { top: 20px; opacity: 1; }
    }

    /* RESPONSIVE */
    @media (max-width: 640px) {
        .menu-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
        }
        .card-img-wrapper {
            height: 120px;
        }
        .menu-name {
            font-size: 0.9rem;
        }
    }
</style>
@endpush

@section('content')

{{-- NOTIFIKASI SUKSES --}}
@if(session('success'))
<div id="toast-notification" class="toast-show">
    <i class="fa-solid fa-check-circle"></i>
    {{ session('success') }}
</div>
@endif

{{-- HEADER PENCARIAN --}}
<div class="main-header">
    <button class="hamburger-menu" onclick="openSidebar()" type="button">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="main-search-container">
        <input type="text" class="search-input" placeholder="Mau makan apa hari ini?" id="searchInput" oninput="liveSearch()" onfocus="liveSearch()">
        <i class="fa-solid fa-magnifying-glass search-icon"></i>
    </div>
</div>

{{-- HASIL PENCARIAN (Suggestion Box) --}}
<div id="suggestionsBox"></div>

{{-- AREA UTAMA (Bisa disembunyikan saat search aktif jika mau, tapi di sini saya biarkan tampil) --}}
<div id="mainContentArea">
    
    {{-- BAGIAN 1: PAKET HEMAT SEHAT --}}
    @if($paketHemat->count() > 0)
        <div class="section-title">
            🥗 Paket Hemat Sehat
            <span>Terlaris</span>
        </div>

        <div class="menu-grid">
            @foreach($paketHemat as $menu)
            {{-- Tambahkan ID untuk Scroll To --}}
            <div class="menu-card" id="menu-{{ $menu->id }}" style="border: 2px solid #e0e9cf;">
                <div class="card-img-wrapper">
                    <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}">
                    <div class="badge-hemat">HEMAT</div>
                </div>
                <div class="card-body" style="background: #fcfdf9;">
                    <h4 class="menu-name">{{ $menu->name }}</h4>
                    <p class="menu-desc">{{ $menu->description }}</p>
                    <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                    
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-add">
                            <i class="fa-solid fa-cart-plus"></i> Pesan
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    {{-- BAGIAN 2: MENU REGULER --}}
    <div class="section-title">
        🍽️ Menu Reguler
    </div>

    <div class="menu-grid">
        @forelse($menuReguler as $menu)
        <div class="menu-card" id="menu-{{ $menu->id }}">
            <div class="card-img-wrapper">
                <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}">
            </div>
            <div class="card-body">
                <h4 class="menu-name">{{ $menu->name }}</h4>
                <p class="menu-desc">{{ $menu->description }}</p>
                <div class="menu-price">Rp {{ number_format($menu->price, 0, ',', '.') }}</div>
                
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-add">
                        <i class="fa-solid fa-plus"></i> Tambah
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #a0aec0;">
            <i class="fa-solid fa-utensils" style="font-size: 2rem; margin-bottom: 10px; display:block;"></i>
            Belum ada menu reguler yang tersedia.
        </div>
        @endforelse
    </div>

</div>

@endsection

@push('scripts')
<script>
    // DATA UNTUK SEARCH (Diambil dari variabel gabungan $menus)
    const ALL_MENUS = @json($menus);

    function liveSearch() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toUpperCase();
        const suggestionsBox = document.getElementById('suggestionsBox');

        // Jika input kosong, sembunyikan saran
        if (filter.length === 0) {
            suggestionsBox.style.display = 'none';
            return;
        }

        // Filter menu berdasarkan nama
        const matches = ALL_MENUS.filter(menu => 
            menu.name.toUpperCase().includes(filter)
        );

        suggestionsBox.style.display = 'block';
        suggestionsBox.innerHTML = '';

        if (matches.length > 0) {
            matches.forEach(menu => {
                const div = document.createElement('div');
                div.className = 'suggestion-item';
                div.innerHTML = `
                    <div style="flex:1;">
                        <strong>${menu.name}</strong><br>
                        <small style="color:#888;">Rp ${new Intl.NumberFormat('id-ID').format(menu.price)}</small>
                    </div>
                    <i class="fa-solid fa-chevron-right" style="color:#ccc;"></i>
                `;
                // Saat diklik, scroll ke kartu menu tersebut
                div.onclick = () => {
                    const targetCard = document.getElementById(`menu-${menu.id}`);
                    if(targetCard) {
                        targetCard.scrollIntoView({behavior: "smooth", block: "center"});
                        // Beri highlight sejenak
                        targetCard.style.border = "2px solid #879b55";
                        setTimeout(() => targetCard.style.border = "", 2000);
                    }
                    suggestionsBox.style.display = 'none';
                    input.value = ''; // Kosongkan input setelah memilih
                };
                suggestionsBox.appendChild(div);
            });
        } else {
            suggestionsBox.innerHTML = '<div class="suggestion-item" style="color:#999;">Menu tidak ditemukan</div>';
        }
    }

    // Hilangkan notifikasi otomatis
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast-notification');
        if (toast) {
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transition = 'opacity 0.5s ease';
                setTimeout(() => toast.remove(), 500);
            }, 3000);
        }
    });

    // Tutup saran jika klik di luar
    document.addEventListener('click', function(e) {
        const suggestionsBox = document.getElementById('suggestionsBox');
        const searchInput = document.getElementById('searchInput');
        if (e.target !== searchInput && e.target !== suggestionsBox) {
            suggestionsBox.style.display = 'none';
        }
    });
</script>
@endpush