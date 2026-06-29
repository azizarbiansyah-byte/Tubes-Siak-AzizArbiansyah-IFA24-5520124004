<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Matakuliah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $data['krs'] = Krs::with('matakuliah')->where('npm', $user->npm)->get();

        return view('pages.krs.daftar-krs', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $npm = Auth::user()->npm;

        $sudahDiambil = Krs::where('npm', $npm)->pluck('kode_matakuliah');

        $data['matakuliah'] = Matakuliah::whereNotIn('kode_matakuliah', $sudahDiambil)->get();

        return view('pages.krs.create-krs', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah'
        ]);

        $user = Auth::user();

        $validated['npm'] = $user->npm;

        $konflik = Krs::where('npm', $validated['npm'])
            ->where('kode_matakuliah', $validated['kode_matakuliah'])
            ->exists();

        if($konflik){
            return back()->withErrors([
                'kode_matakuliah' => 'Matakuliah sudah diambil'
            ])->withInput();
        }

        Krs::create($validated);

        return redirect()->route('krs.index')->with('success', 'Mata Kuliah berhasil ditambahkan');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $npm = Auth::user()->npm;

        $krs = Krs::where('id', $id)->where('npm', $npm)->firstOrFail();

        $krs->delete();

        return redirect()->route('krs.index')->with('success', 'Mata Kuliah berhasil di-drop!');
    }

    public function export()
    {
        $npm = Auth::user()->npm;

        $data['krs'] = Krs::with('matakuliah')->where('npm', $npm)->get();

        $data['mahasiswa'] = Auth::user()->mahasiswa;

        $pdf = Pdf::loadView('pages.krs.pdf', $data);

        return $pdf->stream('KRS-' . $npm . '.pdf');
    }
}