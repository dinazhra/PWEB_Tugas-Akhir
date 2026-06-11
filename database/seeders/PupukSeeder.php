<?php

namespace Database\Seeders;

use App\Models\Pupuk;
use Illuminate\Database\Seeder;

class PupukSeeder extends Seeder  // ← ganti jadi PupukSeeder
{
    public function run(): void
    {
        $data = [
            ['kode'=>'PRD-001','nama'=>'Urea Granul',    'kategori'=>'Kimia',  'stok'=>50,'harga'=>85000, 'tanggal_masuk'=>'2026-01-10'],
            ['kode'=>'PRD-002','nama'=>'Pupuk Kompos',   'kategori'=>'Organik','stok'=>8, 'harga'=>45000, 'tanggal_masuk'=>'2026-02-05'],
            ['kode'=>'PRD-003','nama'=>'NPK Mutiara',    'kategori'=>'Kimia',  'stok'=>30,'harga'=>120000,'tanggal_masuk'=>'2026-02-20'],
            ['kode'=>'PRD-004','nama'=>'Pupuk Cair Bio', 'kategori'=>'Cair',   'stok'=>5, 'harga'=>65000, 'tanggal_masuk'=>'2026-03-01'],
            ['kode'=>'PRD-005','nama'=>'ZA Kristal',     'kategori'=>'Kimia',  'stok'=>25,'harga'=>55000, 'tanggal_masuk'=>'2026-03-10'],
            ['kode'=>'PRD-006','nama'=>'Pupuk Kandang',  'kategori'=>'Organik','stok'=>7, 'harga'=>35000, 'tanggal_masuk'=>'2026-03-15'],
        ];

        foreach ($data as $item) {
            Pupuk::create($item);
        }
    }
}