<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listJadwal = [
            ['kode_matakuliah' => 'IF350122', 'nidn' => '0001234501', 'kelas' => 'A', 'hari' => 'Senin', 'jam' => '2026-06-30 08:00:00'],
            ['kode_matakuliah' => 'IF451223', 'nidn' => '0001234502', 'kelas' => 'B', 'hari' => 'Rabu', 'jam' => '2026-06-30 10:30:00'],
            ['kode_matakuliah' => 'IF460223', 'nidn' => '0001234503', 'kelas' => 'A', 'hari' => 'Sabtu', 'jam' => '2026-06-30 13:00:00']
        ];

        foreach($listJadwal as $jadwal){
            Jadwal::create($jadwal);
        }
    }
}