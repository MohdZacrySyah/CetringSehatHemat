@extends('layouts.admin')

@section('title', 'Tambah Menu')
@section('header', 'Tambah Menu Baru')

@section('content')
<div style="background: white; padding: 20px; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); max-w-2xl;">
    
    {{-- Tampilkan Error Validasi jika ada --}}
    @if ($errors->any())
        <div style="background-color: #fee2e2; color: #991b1b; padding: 10px; border-radius: 8px; margin-bottom: 15px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM START --}}
    {{-- PENTING: enctype="multipart/form-data" WAJIB ADA UNTUK UPLOAD GAMBAR --}}
    <form action="{{ route('admin.menus.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #374151;">Nama Makanan</label>
            <input type="text" name="name" value="{{ old('name') }}" 
                   style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #374151;">Deskripsi</label>
            <textarea name="description" rows="3" 
                      style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;" required>{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #374151;">Harga (Rp)</label>
            <input type="number" name="price" value="{{ old('price') }}" 
                   style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px;" required>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold; color: #374151;">Foto Makanan</label>
            <input type="file" name="image" 
                   style="width: 100%; padding: 10px; border: 1px solid #d1d5db; border-radius: 8px; background: #f9fafb;" required>
            <small style="color: #6b7280;">Format: JPG, PNG, JPEG. Max 2MB.</small>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: flex; align-items: center; cursor: pointer;">
                <input type="checkbox" name="is_paket_hemat" value="1" 
                       style="width: 18px; height: 18px; margin-right: 10px; cursor: pointer;">
                <span style="font-weight: bold; color: #374151;">Masuk kategori Paket Hemat?</span>
            </label>
        </div>

        <div style="text-align: right;">
            <button type="submit" 
                    style="background: #4A572A; color: white; padding: 12px 24px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer; transition: background 0.2s;">
                Simpan Menu
            </button>
        </div>
    </form>
</div>
@endsection