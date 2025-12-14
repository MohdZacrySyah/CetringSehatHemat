<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderArchive;
use Illuminate\Support\Facades\Auth;

class OrderArchiveController extends Controller
{
    // List pesanan cancel (arsip)
    public function index()
    {
        $userId = Auth::id();
        
        // Pastikan ini mengambil dari database, bukan array hardcode
        $canceledOrders = OrderArchive::where('user_id', $userId)
            ->where('status', 'cancelled')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('arsip-pesanan', compact('canceledOrders'));
    }

    // Detail pembatalan
    public function detail($id)
    {
        $order = OrderArchive::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('arsip-detail', compact('order'));
    }

    // Beli lagi (menampilkan form pesan kembali)
    public function buyAgain($id)
    {
        $order = OrderArchive::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('arsip-buy-again', compact('order'));
    }

    // Hapus arsip
    public function destroy($id)
    {
        $order = OrderArchive::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $order->delete();

        return redirect()->route('arsip.index')->with('success', 'Arsip pesanan berhasil dihapus!');
    }

    // Hapus semua arsip
    public function clearAll()
    {
        OrderArchive::where('user_id', Auth::id())->delete();

        return redirect()->route('arsip.index')->with('success', 'Semua arsip pesanan berhasil dihapus!');
    }
}
