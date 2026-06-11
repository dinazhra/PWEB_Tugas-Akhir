<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX — router ke admin/customer view
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {

            $chats = Chat::with([
                    'customer:id,name,email',
                    'messages' => fn($q) => $q->latest()->limit(1)
                ])
                ->withCount([
                    'messages as unread_count' => fn($q) => $q
                        ->where('is_read', false)
                        ->where('sender_id', '!=', auth()->id())
                ])
                ->latest()
                ->get();

            return view('chat.admin', compact('chats'));
        }

        // CUSTOMER
        $admin = User::where('role', 'admin')->first();

        $chat = Chat::firstOrCreate([
            'customer_id' => $user->id,
            'admin_id'    => $admin->id,
        ]);

        $messages = Message::where('chat_id', $chat->id)
            ->with('sender:id,name,role')
            ->orderBy('created_at')
            ->limit(50)
            ->get();

        return view('chat.index', compact('chat', 'messages'));
    }

    /*
    |--------------------------------------------------------------------------
    | SEND — customer kirim pesan
    |--------------------------------------------------------------------------
    */

    public function send(Request $request)
    {
        $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'message' => 'required|string|max:1000',
        ]);

        Message::create([
            'chat_id'   => $request->chat_id,
            'sender_id' => auth()->id(),
            'message'   => $request->message,
            'is_read'   => false,
        ]);

        return response()->json(['status' => 'ok']);
    }

    /*
    |--------------------------------------------------------------------------
    | POLL — customer polling pesan baru
    |--------------------------------------------------------------------------
    */

    public function poll(Request $request)
    {
        $chat = Chat::where('customer_id', auth()->id())->first();

        if (!$chat) return response()->json(['messages' => []]);

        $lastId = (int) $request->last_id;

        $messages = Message::where('chat_id', $chat->id)
            ->where('id', '>', $lastId)
            ->with('sender:id,name,role')
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'id'      => $m->id,
                'message' => $m->message,
                'is_mine' => $m->sender_id === auth()->id(),
                'sender'  => $m->sender->name,
                'time'    => $m->created_at->format('H:i'),
            ]);

        Message::where('chat_id', $chat->id)
            ->where('is_read', false)
            ->where('sender_id', '!=', auth()->id())
            ->update(['is_read' => true]);

        return response()->json(['messages' => $messages]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN SEND — admin balas pesan (return data lengkap untuk render bubble)
    |--------------------------------------------------------------------------
    */

    public function adminSend(Request $request, Chat $chat)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $msg = Message::create([
            'chat_id'   => $chat->id,
            'sender_id' => auth()->id(),
            'message'   => $request->message,
            'is_read'   => false,
        ]);

        return response()->json([
            'status'  => 'ok',
            'id'      => $msg->id,
            'message' => $msg->message,
            'time'    => $msg->created_at->format('H:i'),
            'is_mine' => true,
            'sender'  => auth()->user()->name,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN POLL — admin polling pesan baru
    |--------------------------------------------------------------------------
    */

    public function adminPoll(Request $request, Chat $chat)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $lastId = (int) $request->last_id;

        $messages = Message::where('chat_id', $chat->id)
            ->where('id', '>', $lastId)
            ->with('sender:id,name,role')
            ->orderBy('created_at')
            ->get()
            ->map(fn($m) => [
                'id'      => $m->id,
                'message' => $m->message,
                'is_mine' => $m->sender_id === auth()->id(),
                'sender'  => $m->sender->name,
                'time'    => $m->created_at->format('H:i'),
            ]);

        Message::where('chat_id', $chat->id)
            ->where('is_read', false)
            ->where('sender_id', '!=', auth()->id())
            ->update(['is_read' => true]);

        return response()->json(['messages' => $messages]);
    }

    /*
    |--------------------------------------------------------------------------
    | ADMIN SHOW — tidak dipakai lagi (digabung di admin.blade.php)
    | Dibiarkan supaya route lama tidak error
    |--------------------------------------------------------------------------
    */

    public function adminShow(Chat $chat)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $messages = Message::where('chat_id', $chat->id)
            ->with('sender:id,name,role')
            ->orderBy('created_at')
            ->limit(50)
            ->get();

        Message::where('chat_id', $chat->id)
            ->where('is_read', false)
            ->where('sender_id', '!=', auth()->id())
            ->update(['is_read' => true]);

        return view('chat.admin-show', compact('chat', 'messages'));
    }
}