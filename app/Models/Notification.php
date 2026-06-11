<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notification extends Model
{
    protected $fillable = [
        'user_id',
        'type',
        'message',
        'data',
        'is_read',
    ];

    protected $casts = [
        'data'    => 'array',
        'is_read' => 'boolean',
    ];

    // Relasi ke user penerima
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // ── Static helper: buat notifikasi baru ─────────────────────────

    /**
     * Notif ke admin: ada pesanan masuk
     * Dipanggil di OrderController::store()
     */
    public static function newOrder(int $adminId, int $orderId, string $customerName): void
    {
        static::create([
            'user_id' => $adminId,
            'type'    => 'new_order',
            'message' => "Pesanan baru dari {$customerName}.",
            'data'    => ['order_id' => $orderId],
        ]);
    }

    /**
     * Notif ke admin: stok pupuk di bawah minimum
     * Dipanggil di PupukController saat update stok
     */
    public static function lowStock(int $adminId, int $pupukId, string $namaPupuk, int $stok): void
    {
        static::create([
            'user_id' => $adminId,
            'type'    => 'low_stock',
            'message' => "Stok {$namaPupuk} tinggal {$stok}, segera restok.",
            'data'    => ['pupuk_id' => $pupukId, 'stok' => $stok],
        ]);
    }

    /**
     * Notif ke customer: status pesanan berubah
     * Dipanggil di admin OrderController saat update status
     */
    public static function orderStatus(int $customerId, int $orderId, string $status): void
    {
        $messages = [
            'diproses'  => "Pesanan #$orderId sedang diproses.",
            'dikirim'   => "Pesanan #$orderId sudah dikirim, segera cek.",
            'selesai'   => "Pesanan #$orderId telah selesai. Terima kasih!",
            'dibatalkan'=> "Pesanan #$orderId dibatalkan.",
        ];

        static::create([
            'user_id' => $customerId,
            'type'    => 'order_status',
            'message' => $messages[$status] ?? "Status pesanan #$orderId diperbarui.",
            'data'    => ['order_id' => $orderId, 'status' => $status],
        ]);
    }
}