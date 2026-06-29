<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$data['dosen'] = Dosen::all();
        $search = $request->keyword;

        $dosen = Dosen::when($search, function($query, $search) {
                    return $query->where('nidn', 'like', "%{$search}%")
                                ->orWhere('nama', 'like', "%{$search}%");
                })
                ->orderBy('nama', 'asc')
                ->paginate(10)
                ->withQueryString();

        return view('pages.dosen.daftar-dosen', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.dosen.create-dosen');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nidn' => 'required|size:10|unique:dosen,nidn',
                'nama' => 'required|max:50'
            ]
        );

        Dosen::create($validated);

        return redirect()->route('dosen.index')->with('success', 'Dosen baru berhasil ditambahkan!');
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
        $data['dosen'] = Dosen::findOrFail($id);
        return view('pages.dosen.create-dosen', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|max:50'
            ]
        );

        Dosen::where('nidn', $id)->update($validated);

        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data Dosen berhasil dihapus!');
    }
}