<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Ambil semua notifikasi milik user yang login.
     * Dipakai oleh widget bell (polling tiap 10 detik).
     */
    public function index()
    {
        $notifs = Notification::where('user_id', Auth::id())
                    ->orderByDesc('created_at')
                    ->limit(20)
                    ->get()
                    ->map(fn($n) => [
                        'id'         => $n->id,
                        'type'       => $n->type,
                        'message'    => $n->message,
                        'is_read'    => $n->is_read,
                        'data'       => $n->data,
                        'time'       => $n->created_at->diffForHumans(),
                    ]);

        return response()->json($notifs);
    }

    /**
     * Hitung notifikasi yang belum dibaca (untuk badge).
     */
    public function unreadCount()
    {
        $count = Notification::where('user_id', Auth::id())
                             ->where('is_read', false)
                             ->count();

        return response()->json(['count' => $count]);
    }

    /**
     * Tandai satu notifikasi sebagai sudah dibaca.
     */
    public function markRead(Notification $notification)
    {
        // Pastikan notif ini milik user yang login
        if ($notification->user_id !== Auth::id()) {
            abort(403);
        }

        $notification->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }

    /**
     * Tandai SEMUA notifikasi user ini sebagai sudah dibaca.
     */
    public function markAllRead()
    {
        Notification::where('user_id', Auth::id())
                    ->where('is_read', false)
                    ->update(['is_read' => true]);

        return response()->json(['success' => true]);
    }
}