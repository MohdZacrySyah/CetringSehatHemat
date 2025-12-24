@extends('layouts.admin')

@section('title', 'Kelola Menu')
@section('header', 'Daftar Menu Makanan')

@section('content')
<div style="background: white; border-radius: 15px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3 style="margin: 0; font-weight: bold;">List Makanan & Minuman</h3>
        <a href="{{ route('admin.menus.create') }}" style="background: #4A572A; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: bold;">
            + Tambah Menu
        </a>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f1f5f9; text-align: left;">
                    <th style="padding: 15px;">Gambar</th>
                    <th style="padding: 15px;">Nama Menu</th>
                    <th style="padding: 15px;">Harga</th>
                    <th style="padding: 15px;">Kategori</th>
                    <th style="padding: 15px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 15px;">
                        <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                    </td>
                    <td style="padding: 15px; font-weight: 600;">{{ $menu->name }}</td>
                    <td style="padding: 15px;">Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                    <td style="padding: 15px;">
                        @if($menu->is_paket_hemat)
                            <span style="background: #dcfce7; color: #166534; padding: 4px 8px; border-radius: 20px; font-size: 0.8rem;">Paket Hemat</span>
                        @else
                            <span style="background: #f1f5f9; color: #475569; padding: 4px 8px; border-radius: 20px; font-size: 0.8rem;">Reguler</span>
                        @endif
                    </td>
                    <td style="padding: 15px;">
                        <div style="display: flex; gap: 10px;">
                            <a href="{{ route('admin.menus.edit', $menu->id) }}" style="background: #eab308; color: white; padding: 6px 12px; border-radius: 6px; text-decoration: none; font-size: 0.9rem;">Edit</a>
                            
                            <form action="{{ route('admin.menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus menu ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: #ef4444; color: white; border: none; padding: 6px 12px; border-radius: 6px; cursor: pointer; font-size: 0.9rem;">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 30px; color: #999;">Belum ada menu makanan. Silakan tambah menu baru.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 20px;">
        {{ $menus->links() }}
    </div>
</div>
@endsection