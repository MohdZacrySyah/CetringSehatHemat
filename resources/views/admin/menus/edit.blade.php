@extends('layouts.admin')

@section('title', 'Edit Menu')
@section('header', 'Edit Menu Makanan')

@section('content')
<div style="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-sm">
    <div style="margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
        <h3 style="font-weight: bold; margin: 0;">Edit Data Menu</h3>
    </div>

    <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Nama Makanan</label>
            <input type="text" name="name" value="{{ $menu->name }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Deskripsi</label>
            <textarea name="description" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;" required>{{ $menu->description }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Harga (Rp)</label>
            <input type="number" name="price" value="{{ $menu->price }}" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: 600;">Ganti Foto (Opsional)</label>
            <input type="file" name="image" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 8px;">
            <div style="margin-top: 10px;">
                <p style="font-size: 0.8rem; color: #666; margin-bottom: 5px;">Foto Saat Ini:</p>
                <img src="{{ asset($menu->image) }}" style="width: 100px; border-radius: 8px;">
            </div>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: flex; align-items: center; gap: 10px;">
                <input type="checkbox" name="is_paket_hemat" {{ $menu->is_paket_hemat ? 'checked' : '' }} style="width: 18px; height: 18px;">
                <span>Masuk kategori <strong>Paket Hemat</strong>?</span>
            </label>
        </div>

        <div style="text-align: right; display: flex; gap: 10px; justify-content: flex-end;">
            <a href="{{ route('admin.menus') }}" style="background: #94a3b8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px;">Batal</a>
            <button type="submit" style="background: #4A572A; color: white; padding: 10px 20px; border: none; border-radius: 8px; cursor: pointer; font-weight: bold;">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection