<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['mahasiswa'] = Mahasiswa::with('dosen')->get();

        return view('pages.mahasiswa.daftar-mahasiswa', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['dosen'] = Dosen::all();
        return view('pages.mahasiswa.create-mahasiswa', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'npm' => 'required|size:10|unique:mahasiswa,npm',
                'nidn' => 'required|exists:dosen,nidn',
                'nama' => 'required|max:50'
            ]
        );

        $mahasiswa = Mahasiswa::create($validated);

        $user = User::create([
            'name'     => $mahasiswa->nama,
            'email'    => $mahasiswa->npm . '@student.unsur.ac.id',
            'password' => Hash::make('password'),
            'npm'      => $mahasiswa->npm,
        ]);

        $user->assignRole('Mahasiswa');

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa baru berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['mahasiswa'] = Mahasiswa::findOrFail($id);
        $data['dosen'] = Dosen::all();
        return view('pages.mahasiswa.create-mahasiswa', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $mahasiswa = Mahasiswa::findOrFail($id);

        $validated = $request->validate(
            [
                'npm' => 'required|size:10|unique:mahasiswa,npm,' . $id . ',npm',
                'nidn' => 'required|exists:dosen,nidn',
                'nama' => 'required|max:50'
            ]
        );

        $mahasiswa->update($validated);

        $mahasiswa->user->update([
            'name' => $validated['nama']
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);

        if($mahasiswa->user){
            $mahasiswa->user->delete();
        }

        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa berhasil dihapus!');
    }
}