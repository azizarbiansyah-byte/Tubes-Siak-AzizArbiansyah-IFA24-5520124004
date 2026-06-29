<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswaList = [
            ['npm' => '5520124001', 'nidn' => '0001234501', 'nama' => 'Aziz'],
            ['npm' => '5520123001', 'nidn' => '0001234502', 'nama' => 'Arbi'],
            ['npm' => '5520123002', 'nidn' => '0001234502', 'nama' => 'Ansyah'],
            ['npm' => '5520124002', 'nidn' => '0001234503', 'nama' => 'Nakhesa'],
            ['npm' => '5520124003', 'nidn' => '0001234503', 'nama' => 'Rania']
        ];

        foreach($mahasiswaList as $data){
            $mahasiswa = Mahasiswa::create($data);
            
            $user = User::create([
                'name'     => $mahasiswa->nama,
                'username' => $mahasiswa->npm,
                'email'    => strtolower(str_replace(' ', '', $mahasiswa->nama)) . '@gmail.com',
                'password' => Hash::make('password'),
                'npm'      => $mahasiswa->npm,
            ]);

            $user->assignRole('Mahasiswa');
        }
    }
}