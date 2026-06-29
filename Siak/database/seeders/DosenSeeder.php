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
            ['nidn' => '0001234501', 'nama' => 'Aziz'],
            ['nidn' => '0001234502', 'nama' => 'Ansyah'],
            ['nidn' => '0001234503', 'nama' => 'Arbi'],
        ];

        foreach ($dosenList as $dosen) {
            Dosen::create($dosen);
        }
    }
}