<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['matakuliah'] = Matakuliah::all();

        return view('pages.matakuliah.daftar-matakuliah', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.matakuliah.create-matakuliah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'kode_matakuliah' => 'required|size:8|unique:matakuliah,kode_matakuliah',
                'nama_matakuliah' => 'required|max:50',
                'sks' => 'required|integer|min:1|max:6'
            ]
        );

        Matakuliah::create($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Mata Kuliah baru berhasil ditambahkan!');
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
        $data['matakuliah'] = Matakuliah::findOrFail($id);
        return view('pages.matakuliah.create-matakuliah', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'kode_matakuliah' => 'required|size:8|unique:matakuliah,kode_matakuliah,' . $id . ',kode_matakuliah',
                'nama_matakuliah' => 'required|max:50',
                'sks' => 'required|integer|min:1|max:6'
            ]
        );

        Matakuliah::where('kode_matakuliah', $id)->update($validated);

        return redirect()->route('matakuliah.index')->with('success', 'Data Mata Kuliah berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $matakuliah = Matakuliah::findOrFail($id);
        $matakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Data Mata Kuliah berhasil dihapus!');
    }
}