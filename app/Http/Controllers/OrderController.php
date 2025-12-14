<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Halaman struktur pembayaran (dari cart)
    public function struktur()
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->with('menu')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }

        $subtotal = $carts->sum(function ($cart) {
            return $cart->menu->price * $cart->quantity;
        });

        $biayaPengiriman = 0; // Gratis atau sesuaikan
        $biayaAplikasi = 1000;
        $totalBayar = $subtotal + $biayaPengiriman + $biayaAplikasi;

        return view('order.struktur', compact('carts', 'user', 'subtotal', 'biayaPengiriman', 'biayaAplikasi', 'totalBayar'));
    }

    // Proses checkout - create order
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->with('menu')->get();

        if ($carts->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        try {
            $subtotal = $carts->sum(function ($cart) {
                return $cart->menu->price * $cart->quantity;
            });

            $biayaPengiriman = 0;
            $biayaAplikasi = 1000;
            $totalBayar = $subtotal + $biayaPengiriman + $biayaAplikasi;

            // Create order
            $order = Order::create([
                'order_number' => Order::generateOrderNumber(),
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'biaya_pengiriman' => $biayaPengiriman,
                'biaya_aplikasi' => $biayaAplikasi,
                'total_bayar' => $totalBayar,
                'status' => 'pending',
            ]);

            // Create order items
            foreach ($carts as $cart) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'menu_id' => $cart->menu_id,
                    'menu_name' => $cart->menu->name,
                    'price' => $cart->menu->price,
                    'quantity' => $cart->quantity,
                    'subtotal' => $cart->menu->price * $cart->quantity,
                ]);
            }

            // Hapus cart setelah checkout
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            // Redirect ke halaman pilih metode pembayaran
            return redirect()->route('order.payment.method', $order->id);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal membuat pesanan: ' . $e->getMessage());
        }
    }

    // Halaman pilih metode pembayaran
    public function paymentMethod($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order.payment-method', compact('order'));
    }

    // Proses pilih metode pembayaran
    public function selectPaymentMethod(Request $request, $orderId)
    {
        $request->validate([
            'payment_method' => 'required|in:dana,gopay,linkaja,ovo,qris',
        ]);

        $order = Order::findOrFail($orderId);
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->update([
            'payment_method' => $request->payment_method,
        ]);

        // Redirect ke halaman pembayaran sesuai metode
        return redirect()->route('order.payment.show', $order->id);
    }

    // Halaman pembayaran (tampilkan QR/detail)
    public function showPayment($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order.payment-show', compact('order'));
    }

    // Konfirmasi pembayaran
    public function confirmPayment($orderId)
    {
        $order = Order::findOrFail($orderId);
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return redirect()->route('order.success', $order->id)->with('success', 'Pembayaran berhasil!');
    }

    // Halaman sukses
    public function success($orderId)
    {
        $order = Order::with('items')->findOrFail($orderId);
        
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('order.success', compact('order'));
    }
}
