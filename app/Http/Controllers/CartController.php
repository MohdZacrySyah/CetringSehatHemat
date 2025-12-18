<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // 1. TAMPILKAN HALAMAN KERANJANG
    public function show()
    {
        $userId = Auth::id();
        
        // Ambil data keranjang milik user yang sedang login, beserta data menunya
        $carts = Cart::where('user_id', $userId)->with('menu')->get();
        
        // Hitung total bayar
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->menu->price * $cart->quantity;
        }

        return view('keranjang', compact('carts', 'total'));
    }

    // 2. TAMBAH ITEM KE KERANJANG
    public function add(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $userId = Auth::id();
        $menuId = $request->menu_id;
        $quantity = $request->quantity;

        // Cek apakah menu ini sudah ada di keranjang user?
        $cartItem = Cart::where('user_id', $userId)
                        ->where('menu_id', $menuId)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlahnya
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => $userId,
                'menu_id' => $menuId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil masuk keranjang! 🛒');
    }

    // 3. UPDATE JUMLAH ITEM (Tombol + / - di keranjang)
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->update(['quantity' => $request->quantity]);

        return redirect()->route('cart')->with('success', 'Jumlah diupdate.');
    }

    // 4. HAPUS SATU ITEM
    public function remove($id)
    {
        $cart = Cart::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $cart->delete();

        return redirect()->route('cart')->with('success', 'Item dihapus dari keranjang.');
    }

    // 5. KOSONGKAN KERANJANG
    public function clear()
    {
        Cart::where('user_id', Auth::id())->delete();
        return redirect()->route('cart')->with('success', 'Keranjang dikosongkan.');
    }
}