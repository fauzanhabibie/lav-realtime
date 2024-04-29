<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk; 


class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Produk::create([
            'nama' => 'Laptop',
            'deskripsi' => 'Laptop yang sangat cepat dan ringan.',
            'harga' => 12000000, // Contoh harga dalam rupiah
        ]);

        Produk::create([
            'nama' => 'Smartphone',
            'deskripsi' => 'Smartphone terbaru dengan kamera berkualitas tinggi.',
            'harga' => 6000000,
        ]);
        
    }
}
