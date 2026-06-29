<?php

namespace Database\Seeders;

use App\Models\Matakuliah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatakuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listMatkul = [
            ['kode_matakuliah' => 'IF350122', 'nama_matakuliah' => 'Basdat', 'sks' => 2],
            ['kode_matakuliah' => 'IF451223', 'nama_matakuliah' => 'Basdat II', 'sks' => 3],
            ['kode_matakuliah' => 'IF460223', 'nama_matakuliah' => 'Pemerograman Dasar', 'sks' => 3]
        ];

        foreach($listMatkul as $matkul){
            Matakuliah::create($matkul);
        }
    }
}