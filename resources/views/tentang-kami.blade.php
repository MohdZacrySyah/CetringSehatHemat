@extends('layouts.app')
@section('title', 'Tentang Kami')

@push('styles')
<style>
    body {
        background: #8ea85f;
    }

    .about-page {
        max-width: 1180px;
        margin: 0 auto;
        padding: 12px 0 80px 0;
    }

    /* HEADER BAR TIPIS DI ATAS */
    .about-header {
        background-color: #879b55;
        color: #fff;
        padding: 10px 0;
        border-radius: 0 0 0 0;
        font-weight: 600;
        font-size: 0.95rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.12);
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .about-header-inner {
        max-width: 1080px;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    .about-back-btn {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.2rem;
        color: #fff;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
    }
    .about-header-title {
        font-size: 0.95rem;
        font-weight: 600;
    }

    /* KOTAK ATAS (TAU KAH KAMU) */
    .about-top-card-wrap {
        display: flex;
        justify-content: center;
        margin-top: 18px;
    }
    .about-top-card {
        width: 1080px;
        background: #e4efc7;
        border-radius: 6px;
        padding: 8px 12px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.12);
    }
    .about-top-title {
        font-size: 0.8rem;
        font-weight: 700;
        margin: 0 0 5px 0;
        color: #2e3c1d;
    }
    .about-top-text {
        font-size: 0.72rem;
        line-height: 1.4;
        margin: 0;
        color: #2e3c1d;
        max-width: 310px; /* supaya blok teks kecil di kiri seperti desain */
    }

    /* AREA TENGAH: KOTAK BESAR KIRI + KOTAK KECIL KANAN ATAS */
    .about-middle-wrap {
        display: flex;
        justify-content: center;
        margin-top: 26px;
    }
    .about-middle-inner {
        width: 1080px;
        display: flex;
        position: relative;
    }

    /* kotak besar kiri (kosong, hanya panel hijau muda) */
    .about-middle-large {
        flex: 1;
        height: 200px;
        background: #e4efc7;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.12);
    }

    /* kotak kecil kanan, nempel atas seperti desain */
    .about-middle-small {
        width: 320px;
        min-height: 150px;
        background: #f3fbdf;
        border-radius: 6px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.12);
        padding: 8px 10px;
        position: absolute;
        right: 0;
        top: 18px;
    }
    .about-mid-title {
        font-size: 0.78rem;
        font-weight: 700;
        margin: 0 0 5px 0;
        color: #2e3c1d;
        text-align: right;
    }
    .about-mid-text {
        font-size: 0.7rem;
        line-height: 1.35;
        margin: 0;
        color: #2e3c1d;
        text-align: right;
    }

    /* KOTAK BAWAH KECIL DI TENGAH */
    .about-bottom-wrap {
        margin-top: 26px;
        display: flex;
        justify-content: center;
    }
    .about-bottom-card {
        width: 260px;
        background: #e4efc7;
        border-radius: 6px;
        padding: 10px 12px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.12);
        font-size: 0.78rem;
        text-align: center;
        color: #2e3c1d;
        font-weight: 600;
    }

    @media (max-width:1100px){
        .about-top-card,
        .about-middle-inner {
            width: 95vw;
        }
    }
    @media (max-width:780px){
        .about-middle-inner {
            flex-direction: column;
            position: static;
        }
        .about-middle-large {
            width: 100%;
        }
        .about-middle-small {
            position: static;
            margin-top: 12px;
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="about-page">

    {{-- Header tipis --}}
    <div class="about-header">
        <div class="about-header-inner">
            <button class="about-back-btn" onclick="window.history.back()" type="button">
                <i class="fa-solid fa-arrow-left"></i>
            </button>
            <span class="about-header-title">Tentang Kami</span>
        </div>
    </div>

    {{-- Kotak atas: Tau kah Kamu? --}}
    <div class="about-top-card-wrap">
        <div class="about-top-card">
            <h3 class="about-top-title">Tau kah Kamu?</h3>
            <p class="about-top-text">
                Aplikasi CATERING FEAST adalah aplikasi yang membantu
                kamu memesan makanan sehat secara mudah. Dalam satu
                aplikasi, kamu bisa memilih berbagai paket, mengatur
                jadwal pengantaran, dan melakukan pembayaran
                sepenuhnya secara digital / online.
            </p>
        </div>
    </div>

    {{-- Area tengah --}}
    <div class="about-middle-wrap">
        <div class="about-middle-inner">
            <div class="about-middle-large"></div>

            <div class="about-middle-small">
                <h3 class="about-mid-title">Kenapa harus menggunakan<br>Catering Feast?</h3>
                <p class="about-mid-text">
                    Memesan layanan lewat aplikasi CATERING FEAST
                    membuat hidup kamu lebih praktis. Kamu bisa
                    menyesuaikan kebutuhan harian, memilih menu sehat,
                    dan mengatur jadwal pengiriman tanpa ribet. Semua
                    pesanan tercatat dengan rapi sehingga kamu lebih
                    mudah mengontrol pola makan dan anggaran.
                </p>
            </div>
        </div>
    </div>

    {{-- Kotak bawah kecil di tengah --}}
    <div class="about-bottom-wrap">
        <div class="about-bottom-card">
            Masih Ragu Kah Kamu Untuk<br>
            Memesan Catering Feast?
        </div>
    </div>

</div>
@endsection
