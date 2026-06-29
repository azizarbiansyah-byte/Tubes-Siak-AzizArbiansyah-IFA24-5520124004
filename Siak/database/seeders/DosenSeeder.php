<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosenList = [
            ['nidn' => '0001234501', 'nama' => 'Jiraya'],
            ['nidn' => '0001234502', 'nama' => 'Namikaze Minato'],
            ['nidn' => '0001234503', 'nama' => 'Hatake Kakashi'],
        ];

        foreach ($dosenList as $dosen) {
            Dosen::create($dosen);
        }
    }
}