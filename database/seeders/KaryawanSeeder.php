<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
    \App\Models\Karyawan::create([
        'nik' => '1234567890',
        'nama' => 'John Doe',
        'alamat' => 'Jl. Contoh Alamat No. 1'
    ]);

    \App\Models\Karyawan::create([
        'nik' => '0987654321',
        'nama' => 'Jane Doe',
        'alamat' => 'Jl. Contoh Alamat No. 2'
    ]);
    }
}
