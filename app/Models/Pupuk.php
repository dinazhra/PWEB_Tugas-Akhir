<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Cart;
use App\Models\Transaction;

class Pupuk extends Model
{
    protected $fillable = [
        'kode',
        'nama',
        'kategori',
        'stok',
        'harga',
        'tanggal_masuk',
        'foto',
        'user_id',
    ];

    protected $casts = [
        'harga'         => 'decimal:2',
        'stok'          => 'integer',
        'tanggal_masuk' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Scope
    |--------------------------------------------------------------------------
    */

    // Produk dengan stok menipis
    public function scopeMenipis(Builder $query): Builder
    {
        return $query->where('stok', '<', 10);
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    // Relasi ke user/admin pembuat produk
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke cart
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relasi transaksi
    public function transaksi()
    {
        return $this->hasMany(Transaction::class);
    }
}