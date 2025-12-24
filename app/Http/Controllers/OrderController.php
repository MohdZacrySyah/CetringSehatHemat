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
<<<<<<< HEAD
    // Halaman pilih metode pembayaran (langsung dari cart)
    public function paymentMethod()
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->with('menu')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }

        $subtotal = $carts->sum(function ($cart) {
            return $cart->menu->price * $cart->quantity;
        });

        $biayaPengiriman = 1000;
        $biayaAplikasi = 1000;
        $totalBayar = $subtotal + $biayaPengiriman + $biayaAplikasi;

        return view('order.payment-method', compact('carts', 'subtotal', 'biayaPengiriman', 'biayaAplikasi', 'totalBayar'));
    }

    // Proses pilih metode pembayaran & create order
    public function selectPaymentMethod(Request $request)
=======
    /**
     * 1. PROSES CHECKOUT
     * Mengambil item dari cart, memindahkan ke tabel orders, lalu mengosongkan cart.
     */
    public function checkout(Request $request)
>>>>>>> 330fbf27bdd07fbc598550cc5aa908ed5f5a67fe
    {
        $request->validate([
            'payment_method' => 'required|in:dana,gopay,linkaja,ovo,qris,cod',
        ]);

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
<<<<<<< HEAD
            $subtotal = $carts->sum(function ($cart) {
                return $cart->menu->price * $cart->quantity;
            });

            $biayaPengiriman = 1000;
            $biayaAplikasi = 1000;
            $totalBayar = $subtotal + $biayaPengiriman + $biayaAplikasi;

            // Create order
=======
            // A. Buat Order Baru
>>>>>>> 330fbf27bdd07fbc598550cc5aa908ed5f5a67fe
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()), // Contoh: ORD-657A...
                'total_bayar' => $totalBayar,
<<<<<<< HEAD
                'payment_method' => $request->payment_method,
                'custom_note' => $request->custom_note,
                'status' => 'pending',
            ]);

            // Create order items dengan menyimpan gambar
=======
                'status' => 'pending', // Status awal
                'payment_method' => null, // Belum dipilih
            ]);

            // B. Pindahkan Item Cart ke OrderItems
>>>>>>> 330fbf27bdd07fbc598550cc5aa908ed5f5a67fe
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $cart->menu_id,
<<<<<<< HEAD
                    'menu_name' => $cart->menu->name,
                    'menu_image' => $cart->menu->image, // SIMPAN GAMBAR
                    'price' => $cart->menu->price,
=======
>>>>>>> 330fbf27bdd07fbc598550cc5aa908ed5f5a67fe
                    'quantity' => $cart->quantity,
                    'price' => $cart->menu->price, // Simpan harga saat beli (agar aman jika harga menu berubah)
                    'subtotal' => $cart->menu->price * $cart->quantity,
                ]);
            }

            // C. Hapus Keranjang
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

<<<<<<< HEAD
            // Redirect ke halaman detail pembayaran
            return redirect()->route('order.payment.detail', $order->id);
=======
            // Redirect ke halaman pilih metode pembayaran
            // Kita simpan ID order di session agar halaman selanjutnya tahu order mana yang dimaksud
            return redirect()->route('order.payment.method')->with('order_id', $order->id);

>>>>>>> 330fbf27bdd07fbc598550cc5aa908ed5f5a67fe
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat checkout: ' . $e->getMessage());
        }
    }

<<<<<<< HEAD
    // Halaman detail pembayaran (penerima & nomor)
    public function paymentDetail($orderId)
=======
    /**
     * 2. HALAMAN PILIH METODE PEMBAYARAN
     */
    public function paymentMethod()
>>>>>>> 330fbf27bdd07fbc598550cc5aa908ed5f5a67fe
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

        return view('order.payment-detail', compact('order'));
    }

<<<<<<< HEAD
    // Halaman QR Code
    public function showQRCode($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order.payment-qr', compact('order'));
    }

    // Halaman loading
    public function loading($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        // Update status order menjadi paid
        $order->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return view('order.loading', compact('order'));
=======
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
>>>>>>> 330fbf27bdd07fbc598550cc5aa908ed5f5a67fe
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

<<<<<<< HEAD
    // Halaman detail pesanan
    public function detail($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order.detail', compact('order'));
    }
}
=======
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
>>>>>>> 330fbf27bdd07fbc598550cc5aa908ed5f5a67fe
