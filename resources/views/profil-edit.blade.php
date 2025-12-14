@extends('layouts.app')
@section('title', 'Edit Profil')

@push('styles')
<style>
    body {
        background: linear-gradient(180deg, #8B9D5E 0%, #B4C588 100%);
        margin: 0;
        padding: 0;
        min-height: 100vh;
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
    }
    .profile-container {
        max-width: 570px;
        margin: 27px auto 0 auto;
        padding: 0 2vw 86px 2vw;
    }
    .cart-header {
        background-color: #879b55;
        padding: 14px 0;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: relative;
        color: white;
        font-weight: bold;
        font-size: 1.17rem;
        border-radius: 9px;
        margin-bottom: 23px;
        letter-spacing: 0.005em;
    }
    .back-arrow {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 1.48rem;
        color: white;
        text-decoration: none;
        cursor: pointer;
        background: none;
        border: none;
        padding: 0;
        transition: opacity .2s;
    }
    .back-arrow:hover { opacity: 0.8; }
    .success-msg {
        background: #f3ffe0;
        color: #446a20;
        border: 1.6px solid #79a658;
        padding: 13px 18px;
        border-radius: 10px;
        font-weight: 600;
        margin-bottom: 15px;
        margin-top: 0;
        box-shadow: 0 3px 16px #bdd29a17;
        text-align: center;
        font-size: 1rem;
        letter-spacing: .01em;
    }
    .profile-photo-section {
        text-align: center;
        margin-bottom: 22px;
        margin-top: 8px;
    }
    .profile-photo-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 13px;
    }
    .profile-photo {
        width: 104px;
        height: 104px;
        border-radius: 50%;
        background-color: #D4E1B8;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #fff;
        box-shadow: 0 2px 12px #b4c58833;
        overflow: hidden;
    }
    .profile-photo img, .profile-icon {
        width: 88px;
        height: 88px;
        object-fit: cover;
        border-radius: 50%;
    }
    .profile-icon { color: #A3B885; }
    .camera-badge {
        position: absolute;
        bottom: 0;
        right: 1px;
        width: 34px;
        height: 34px;
        background-color: #798F5A;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #B4C588;
        cursor: pointer;
        z-index: 2;
        transition: background .18s;
    }
    .camera-badge:hover { background: #546635; }
    .camera-icon {
        width: 18px;
        height: 18px;
        color: #fff;
    }
    .change-photo-text {
        font-size: 16px;
        color: #25320A;
        font-weight: 600;
        margin-top: 5px;
        margin-bottom: 15px;
    }
    .form-card {
        background-color: #D4E1B8;
        border-radius: 17px;
        padding: 25px 16px 28px 16px;
        margin-bottom: 23px;
        box-shadow: 0 2px 15px #c2d5a02b;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .form-group {
        width: 100%;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #31450e;
        margin-bottom: 6px;
        letter-spacing: 0.025em;
    }
    .form-input {
        width: 100%;
        padding: 14px 13px;
        border: none;
        border-radius: 8px;
        background-color: #E8EFD8;
        font-size: 15px;
        color: #24380a;
        box-sizing: border-box;
        font-family: inherit;
        font-weight: 500;
        margin-bottom: 0;
    }
    .form-input::placeholder {
        color: #6B7B4F;
        font-weight: 400;
    }
    .form-input:focus {
        outline: none;
        background-color: #E0E8D0;
    }
    .form-actions {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
    }
    .save-button {
        background-color: #7A8B5A;
        border-radius: 50%;
        border: none;
        width: 56px;
        height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 4px 8px #8b9d5e33;
        color: #fff;
        font-size: 23px;
        margin-right: 3px;
        transition: background .18s;
    }
    .save-button:hover { background-color: #6B7B4F; }
    .save-icon { width: 26px; height: 26px; color: #fff; }
    
    /* MODAL KONFIRMASI SIMPAN */
    .save-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }
    .save-modal.show {
        display: flex;
    }
    .save-modal-content {
        background: #fff;
        border-radius: 15px;
        padding: 25px;
        max-width: 340px;
        width: 90%;
        text-align: center;
        box-shadow: 0 5px 20px rgba(0,0,0,0.3);
    }
    .save-modal-icon {
        font-size: 3rem;
        color: #7A8B5A;
        margin-bottom: 15px;
    }
    .save-modal-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 10px;
    }
    .save-modal-text {
        font-size: 0.95rem;
        color: #666;
        margin-bottom: 25px;
    }
    .save-modal-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
    }
    .save-modal-btn {
        padding: 10px 24px;
        border: none;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 600;
        cursor: pointer;
        transition: background .18s;
    }
    .save-modal-btn-cancel {
        background: #e0e0e0;
        color: #333;
    }
    .save-modal-btn-cancel:hover {
        background: #d0d0d0;
    }
    .save-modal-btn-confirm {
        background: #7A8B5A;
        color: #fff;
    }
    .save-modal-btn-confirm:hover {
        background: #6B7B4F;
    }
    
    @media (max-width: 600px) {
        .profile-container {padding-left: 4px; padding-right: 4px;}
        .form-card {padding: 15px 2vw 19px 2vw;}
        .cart-header {font-size: 1rem; padding: 10px 0;}
    }
    @media (max-width: 400px) {
        .profile-photo {width:74px;height:74px;}
        .profile-photo img,.profile-icon{width:63px;height:63px;}
        .form-input{padding:10px 8px;}
        .change-photo-text{font-size:13px;}
        .cart-header{font-size:.97rem;}
    }
</style>
@endpush

@section('content')
<div class="cart-header">
    <button class="back-arrow" onclick="window.history.back()" type="button">
        <i class="fa-solid fa-arrow-left"></i>
    </button>
    <span>Edit Profil</span>
</div>

<div class="profile-container">
    @if(session('success'))
    <div class="success-msg">
        {{ session('success') }}
    </div>
    @endif

    <div class="profile-photo-section">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="form-card" autocomplete="off" id="profileForm">
            @csrf
            <div class="profile-photo-section" style="margin-bottom: 0;">
                <div class="profile-photo-wrapper">
                    <div class="profile-photo">
                        @if($user->avatar)
                            <img src="{{ asset('storage/'.$user->avatar) }}" alt="Profil" id="imagePreview">
                        @else
                            <svg id="imagePreview" class="profile-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                ircle cx="12" cy="7" r="4"></circle>
                            </svg>
                        @endif
                    </div>
                    <label class="camera-badge" for="avatarInput">
                        <svg class="camera-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                            ircle cx="12" cy="13" r="4"></circle>
                        </svg>
                        <input type="file" id="avatarInput" name="avatar" accept="image/*" style="display:none;">
                    </label>
                </div>
                <div class="change-photo-text">Ubah Gambar Profil</div>
            </div>

            <div class="form-group">
                <label class="form-label">Nama Pengguna</label>
                <input type="text" name="name" class="form-input" value="{{ $user->name }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Alamat Lengkap</label>
                <input type="text" name="alamat" class="form-input" value="{{ $user->alamat }}">
            </div>
            <div class="form-group">
                <label class="form-label">No. Telpon</label>
                <input type="text" name="telp" class="form-input" value="{{ $user->telp }}">
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-input" value="{{ $user->email }}" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-input" placeholder="••••••••" autocomplete="off">
            </div>
            <div class="form-actions">
                <button type="button" class="save-button" title="Simpan" onclick="showSaveModal()">
                    <svg class="save-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL KONFIRMASI SIMPAN --}}
<div id="saveModal" class="save-modal">
    <div class="save-modal-content">
        <div class="save-modal-icon">
            <i class="fa-solid fa-floppy-disk"></i>
        </div>
        <h3 class="save-modal-title">Konfirmasi Simpan</h3>
        <p class="save-modal-text">Apakah Anda yakin ingin menyimpan perubahan profil?</p>
        <div class="save-modal-buttons">
            <button type="button" class="save-modal-btn save-modal-btn-cancel" onclick="hideSaveModal()">
                Batal
            </button>
            <button type="button" class="save-modal-btn save-modal-btn-confirm" onclick="confirmSave()">
                Ya, Simpan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('avatarInput').addEventListener('change', function(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('imagePreview');
            if (preview.tagName.toLowerCase() === 'svg') {
                const newImg = document.createElement('img');
                newImg.id = 'imagePreview';
                preview.parentNode.replaceChild(newImg, preview);
            }
            document.getElementById('imagePreview').src = URL.createObjectURL(file);
        }
    });

    function showSaveModal() {
        document.getElementById('saveModal').classList.add('show');
    }

    function hideSaveModal() {
        document.getElementById('saveModal').classList.remove('show');
    }

    function confirmSave() {
        document.getElementById('profileForm').submit();
    }

    document.getElementById('saveModal').addEventListener('click', function(e) {
        if (e.target === this) {
            hideSaveModal();
        }
    });
</script>
@endpush
@endsection
