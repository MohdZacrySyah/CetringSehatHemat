<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * 1. PROSES CHECKOUT
     * Mengambil item dari cart, memindahkan ke tabel orders, lalu mengosongkan cart.
     */
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->with('menu')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang Anda kosong.');
        }

        // Hitung Total Bayar
        $totalBayar = 0;
        foreach ($carts as $cart) {
            $totalBayar += $cart->menu->price * $cart->quantity;
        }

        // Tambah biaya admin/ongkir (opsional, bisa dinamis nanti)
        $biayaAplikasi = 2000; 
        $totalBayar += $biayaAplikasi;

        // Gunakan Database Transaction agar data aman
        DB::beginTransaction();
        try {
            // A. Buat Order Baru
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()), // Contoh: ORD-657A...
                'total_bayar' => $totalBayar,
                'status' => 'pending', // Status awal
                'payment_method' => null, // Belum dipilih
            ]);

            // B. Pindahkan Item Cart ke OrderItems
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $cart->menu_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->menu->price, // Simpan harga saat beli (agar aman jika harga menu berubah)
                    'subtotal' => $cart->menu->price * $cart->quantity,
                ]);
            }

            // C. Hapus Keranjang
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            // Redirect ke halaman pilih metode pembayaran
            // Kita simpan ID order di session agar halaman selanjutnya tahu order mana yang dimaksud
            return redirect()->route('order.payment.method')->with('order_id', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }

    /**
     * 2. HALAMAN PILIH METODE PEMBAYARAN
     */
    public function paymentMethod()
    {
        // Ambil order terakhir yang pending dari user ini (atau dari session)
        $orderId = session('order_id');
        
        if (!$orderId) {
            // Jika tidak ada di session, cari order pending terakhir
            $order = Order::where('user_id', Auth::id())
                        ->where('status', 'pending')
                        ->latest()
                        ->first();
        } else {
            $order = Order::find($orderId);
        }

        if (!$order) {
            return redirect()->route('dashboard');
        }

        return view('order.payment-method', compact('order'));
    }

    /**
     * 3. PROSES PILIH PEMBAYARAN
     */
    public function selectPaymentMethod(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'payment_method' => 'required|in:tunai,qris,transfer',
        ]);

        $order = Order::where('id', $request->order_id)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        $order->update([
            'payment_method' => $request->payment_method
        ]);

        // Redirect sesuai metode
        if ($request->payment_method == 'tunai') {
            return redirect()->route('order.success', $order->id);
        } else {
            // Jika QRIS/Transfer, arahkan ke halaman upload bukti/scan
            return redirect()->route('order.payment.detail', $order->id);
        }
    }

    /**
     * 4. DETAIL PEMBAYARAN (Untuk QRIS/Transfer)
     */
    public function paymentDetail($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('order.payment-detail', compact('order'));
    }

    /**
     * 5. LIHAT QR CODE (Opsional jika pakai view terpisah)
     */
    public function showQRCode($id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('order.payment-qr', compact('order'));
    }

    /**
     * 6. KONFIRMASI PEMBAYARAN (Upload Bukti)
     */
    public function confirmPayment(Request $request, $id)
    {
        $order = Order::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        // Jika upload bukti bayar
        if ($request->hasFile('payment_proof')) {
            $file = $request->file('payment_proof');
            $filename = time() . '_proof_' . $file->getClientOriginalName();
            $file->move(public_path('payment_proofs'), $filename);
            
            // Simpan path bukti (pastikan ada kolom 'payment_proof' di tabel orders jika mau disimpan)
            // $order->payment_proof = 'payment_proofs/' . $filename;
        }

        // Ubah status jadi 'paid' (atau 'waiting_confirmation' jika butuh cek admin dulu)
        $order->update(['status' => 'paid']);

        return redirect()->route('order.success', $order->id);
    }

    /**
     * 7. HALAMAN LOADING (Animasi masak/proses)
     */
    public function loading($id)
    {
        $order = Order::findOrFail($id);
        return view('order.loading', compact('order'));
    }

    /**
     * 8. HALAMAN SUKSES / SELESAI
     */
    public function success($id)
    {
        $order = Order::with('orderItems.menu')->findOrFail($id);
        return view('order.success', compact('order'));
    }

    /**
     * 9. DETAIL ORDER (Riwayat)
     */
    public function detail($id)
    {
        $order = Order::with('orderItems.menu')->where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('order.detail', compact('order'));
    }

    /**
     * 10. CETAK STRUK (Opsional)
     */
    public function struktur(Request $request)
    {
        // Logika cetak struk (bisa pakai library PDF atau view print sederhana)
        return view('order.struktur');
    }
    
    // Fungsi tambahan untuk route 'order.payment.show' jika diperlukan
    public function showPayment($id) {
        return $this->paymentDetail($id);
    }
}