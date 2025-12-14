@extends('layouts.app')
@section('title', 'Notifikasi Pesanan')

@push('styles')
<style>
    body {
        background: #bfc993;
    }
    .notif-section {
        max-width: 1070px;
        margin: 0 auto;
        padding: 15px 0 80px 0;
    }
    .notif-header {
        background-color: #879b55;
        color: #fff;
        padding: 15px 0;
        border-radius: 9px;
        font-weight: bold;
        font-size: 1.18rem;
        margin-bottom: 19px;
        margin-top: 22px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.07);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .notif-back-btn {
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
    .notif-actions {
        text-align: right;
        margin-bottom: 15px;
    }
    .mark-all-btn {
        background: #879b55;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-size: 0.9rem;
        cursor: pointer;
    }
    .mark-all-btn:hover {
        background: #556b2f;
    }
    .notif-list-block {
        background: #e0e9cf;
        border-radius: 13px;
        padding: 15px 17px 13px 17px;
        box-shadow: 0 2px 10px #c2d5a023;
        margin-bottom: 18px;
        display: flex;
        align-items: flex-start;
        gap: 13px;
        cursor: pointer;
        transition: background 0.2s;
        text-decoration: none;
        color: inherit;
        position: relative;
    }
    .notif-list-block:hover {
        background: #d0e0bc;
    }
    .notif-list-block.unread {
        border-left: 4px solid #879b55;
    }
    .notif-img {
        width: 54px;
        height: 54px;
        border-radius: 12px;
        object-fit: cover;
        background: #e8efd8;
        border: 1.5px solid #fff;
        box-shadow: 0 1px 3px #9bb48315;
        flex-shrink: 0;
    }
    .notif-main {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }
    .notif-row-top {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .notif-title {
        font-weight: bold;
        font-size: 1rem;
        color: #264614;
    }
    .notif-check {
        color: #54ba2b;
        font-size: 1.18rem;
        margin-top: 2px;
        margin-right: 2px;
    }
    .notif-content {
        color: #334420;
        font-size: .965rem;
        margin: 0;
        margin-top: 8px;
        margin-bottom: 2px;
    }
    .notif-limit {
        color: #158038;
        font-size: .95rem;
        font-weight: 600;
        margin-left: 5px;
    }
    .notif-thanks {
        font-size: .95rem;
        color: #747642;
        margin-top: 10px;
        font-style: italic;
    }
    .notif-delete {
        position: absolute;
        top: 15px;
        right: 15px;
        color: #ab3d36;
        font-size: 1.1rem;
        cursor: pointer;
        z-index: 10;
    }
    .notif-empty {
        text-align: center;
        color: #666;
        padding: 40px 20px;
    }
    @media (max-width: 660px){
        .notif-section {padding-left: 2vw; padding-right: 2vw;}
    }
</style>
@endpush

@section('content')
<div class="notif-header">
    <button class="notif-back-btn" onclick="window.history.back()" type="button">
        <i class="fa-solid fa-arrow-left"></i>
    </button>
    Notifikasi Pesanan
</div>

<div class="notif-section">
    @if($notifications->isEmpty())
        <div class="notif-empty">
            <i class="fa-solid fa-bell-slash" style="font-size:3rem;color:#bbb;margin-bottom:15px;"></i>
            <p>Belum ada notifikasi</p>
        </div>
    @else
        <div class="notif-actions">
            <form action="{{ route('notifikasi.mark-all-read') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="mark-all-btn">
                    <i class="fa-solid fa-check-double"></i> Tandai Semua Dibaca
                </button>
            </form>
        </div>

        @foreach($notifications as $notif)
        <a href="{{ route('notifikasi.detail', $notif->id) }}" class="notif-list-block {{ !$notif->is_read ? 'unread' : '' }}">
            <img src="{{ asset($notif->menu_image) }}" class="notif-img" alt="{{ $notif->menu_name }}">
            <div class="notif-main">
                <div class="notif-row-top">
                    <span class="notif-title">{{ $notif->title }}</span>
                    <span class="notif-check"><i class="fa-solid fa-square-check"></i></span>
                </div>
                <p class="notif-content">
                    {{ $notif->description }}
                    <span class="notif-limit">{{ $notif->formatted_rating_deadline }}</span>
                </p>
                <div class="notif-thanks">Terimakasih atas pesanan anda</div>
            </div>
            <form action="{{ route('notifikasi.destroy', $notif->id) }}" method="POST" onclick="event.stopPropagation(); if(confirm('Hapus notifikasi ini?')) this.submit(); else event.preventDefault();">
                @csrf
                @method('DELETE')
                <button type="submit" class="notif-delete" style="border:none;background:none;">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </a>
        @endforeach
    @endif
</div>
@endsection
