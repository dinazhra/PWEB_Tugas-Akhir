<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'nama', 'email', 'telepon', 'alamat'
    ];

    public function pupuks()
    {
        return $this->belongsToMany(Pupuk::class, 'transaksi')
                    ->withPivot('jumlah', 'harga_jual', 'tanggal')
                    ->withTimestamps();
    }
}