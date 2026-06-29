<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->keyword;

        $matakuliah = Matakuliah::when($search, function($query, $search) {
                        return $query->where('kode_matakuliah', 'like', "%{$search}%")
                                    ->orWhere('nama_matakuliah', 'like', "%{$search}%")
                                    ->orWhere('sks', 'like', "%{$search}%");
                    })
                    ->orderBy('nama_matakuliah', 'asc')
                    ->paginate(10)
                    ->withQueryString();

        return view('pages.matakuliah.daftar-matakuliah', compact('matakuliah'));
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
                'sks' => 'required|integer|in:1,2,3,4,5,6'
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
                'sks' => 'required|integer|in:1,2,3,4,5,6'
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