<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderNotification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // List notifikasi
    public function index()
    {
        $userId = Auth::id();
        $notifications = OrderNotification::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('notifikasi', compact('notifications'));
    }

    // Detail notifikasi (tandai sebagai dibaca)
    public function show($id)
    {
        $notification = OrderNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Tandai sebagai dibaca
        if (!$notification->is_read) {
            $notification->is_read = true;
            $notification->save();
        }

        return view('notifikasi-detail', compact('notification'));
    }

    // Tandai semua sebagai dibaca
    public function markAllRead()
    {
        OrderNotification::where('user_id', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return redirect()->route('notifikasi')->with('success', 'Semua notifikasi ditandai sebagai dibaca!');
    }

    // Hapus notifikasi
    public function destroy($id)
    {
        $notification = OrderNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->delete();

        return redirect()->route('notifikasi')->with('success', 'Notifikasi berhasil dihapus!');
    }
}
