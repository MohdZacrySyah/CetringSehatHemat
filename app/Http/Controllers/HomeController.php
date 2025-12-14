<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
   public function index()
    {
        // menu biasa SAJA (bukan paket hemat)
        $menus = Menu::where('is_paket_hemat', false)->get();

        // menu paket hemat untuk grid
        $paketHemat = Menu::where('is_paket_hemat', true)->get();

        return view('home', compact('menus', 'paketHemat'));
    }
}
