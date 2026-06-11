<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Cart;
use App\Models\Transaksi;
use App\Models\Chat;
use App\Models\Message;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
    'name',
    'username',
    'email',
    'password',
    'role',
    'no_hp',
    'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Helper
    |--------------------------------------------------------------------------
    */

    // Cek apakah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /*
    |--------------------------------------------------------------------------
    | Relasi
    |--------------------------------------------------------------------------
    */

    // Relasi keranjang
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // Relasi transaksi/pembelian
    public function transaksi()
    {
        return $this->hasMany(Transaction::class);
    }

    public function customerChats()
    {
        return $this->hasMany(Chat::class, 'customer_id');
    }

    public function adminChats()
    {
        return $this->hasMany(Chat::class, 'admin_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }
}