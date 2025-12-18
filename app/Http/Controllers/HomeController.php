<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index()
    {
        // Ambil Paket Hemat (is_paket_hemat = true/1)
        $paketHemat = Menu::where('is_paket_hemat', true)->latest()->get();

        // Ambil Menu Biasa (is_paket_hemat = false/0)
        $menuReguler = Menu::where('is_paket_hemat', false)->latest()->get();

        return view('home', compact('paketHemat', 'menuReguler'));
    }
}