<?php

namespace Database\Seeders;

use App\Models\Krs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KrsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $krsList = [
            ['npm' => '5520123001', 'kode_matakuliah' => 'IF460223'],
            ['npm' => '5520123001', 'kode_matakuliah' => 'IF451223'],
            ['npm' => '5520123002', 'kode_matakuliah' => 'IF451223'],
            ['npm' => '5520124001', 'kode_matakuliah' => 'IF451223'],
            ['npm' => '5520124001', 'kode_matakuliah' => 'IF350122'],
            ['npm' => '5520124001', 'kode_matakuliah' => 'IF460223'],
            ['npm' => '5520124002', 'kode_matakuliah' => 'IF350122'],
            ['npm' => '5520124003', 'kode_matakuliah' => 'IF350122']
        ];

        foreach($krsList as $krs){
            Krs::create($krs);
        };

    }
}