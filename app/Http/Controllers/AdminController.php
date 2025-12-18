<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    // 1. DASHBOARD UTAMA
    public function index()
    {
        // Hitung statistik untuk ditampilkan di kartu dashboard
        $totalPendapatan = Order::where('status', 'paid')->sum('total_bayar');
        $pesananBaru = Order::where('status', 'pending')->count();
        $totalMenu = Menu::count();
        $pesananAktif = Order::whereIn('status', ['paid', 'confirmed', 'processing', 'delivering'])->count();

        return view('admin.dashboard', compact('totalPendapatan', 'pesananBaru', 'totalMenu', 'pesananAktif'));
    }

    // 2. MANAJEMEN PESANAN (Lihat semua pesanan)
    public function orders()
    {
        // Ambil pesanan terbaru, diurutkan dari yang terakhir masuk
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    // Update Status Pesanan (Misal: dari 'pending' -> 'processing')
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    // 3. MANAJEMEN MENU (Daftar Menu)
    public function menus()
    {
        $menus = Menu::latest()->paginate(10);
        return view('admin.menus.index', compact('menus'));
    }

    // Form Tambah Menu
    public function createMenu()
    {
        return view('admin.menus.create');
    }

    // Simpan Menu Baru ke Database
    public function storeMenu(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Upload gambar
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Simpan ke folder 'public/image/menus' agar rapi
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('image'), $filename);
            $imagePath = 'image/' . $filename;
        }

        Menu::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath, // Simpan path gambar
            'is_paket_hemat' => $request->has('is_paket_hemat') ? true : false,
        ]);

        return redirect()->route('admin.menus')->with('success', 'Menu berhasil ditambahkan!');
    }

    // Hapus Menu
    public function destroyMenu($id)
    {
        $menu = Menu::findOrFail($id);
        // Hapus file gambar jika ada (opsional)
        // if(file_exists(public_path($menu->image))){ unlink(public_path($menu->image)); }
        
        $menu->delete();
        return redirect()->back()->with('success', 'Menu dihapus.');
    }
}