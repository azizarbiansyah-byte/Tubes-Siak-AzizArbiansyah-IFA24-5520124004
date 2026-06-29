<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->keyword;

        $jadwal = Jadwal::with(['dosen', 'matakuliah'])
            ->when($search, function($query, $search) {
                if (preg_match('/^[A-Fa-f]$/', $search)) {
                    return $query->where('kelas', strtoupper($search));
                }
                return $query->where('hari', 'like', "%{$search}%")
                            ->orWhereHas('matakuliah', function($q) use ($search) {
                                $q->where('nama_matakuliah', 'like', "%{$search}%");
                            });
            })
            ->orderBy('hari', 'asc')
            ->paginate(10)
            ->withQueryString();

        return view('pages.jadwal.daftar-jadwal', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['matakuliah'] = Matakuliah::all();
        $data['dosen'] = Dosen::all();

        return view('pages.jadwal.create-jadwal', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|exists:dosen,nidn',
            'kelas'           => 'required|in:A,B,C,D,E,F',
            'hari'            => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam'             => 'required|date_format:H:i',
        ]);

        $konflikKelas = Jadwal::where('hari', $validated['hari'])
            ->where('jam', '2026-06-30 ' . $validated['jam'] . ':00')
            ->where('kelas', $validated['kelas'])
            ->exists();

        if ($konflikKelas) {
            return back()->withErrors([
                'hari' => 'Jadwal kelas ' . $validated['kelas'] . ' hari ' . $validated['hari'] . ' jam ' . $validated['jam'] . ' sudah ada.'
            ])->withInput();
        }

        $konflikDosen = Jadwal::where('nidn', $request->nidn)
            ->where('hari', $request->hari)
            ->where('jam', '2026-06-30 ' . $request->jam . ':00')
            ->exists();

        if ($konflikDosen) {
            $jadwalDosen = Jadwal::with('matakuliah')
                ->where('nidn', $request->nidn)
                ->where('hari', $request->hari)
                ->where('jam', '2026-06-30 ' . $request->jam . ':00')
                ->first();

            return back()->withErrors([
                'nidn' => 'Dosen ini sudah mengajar ' .
                        ($jadwalDosen->matakuliah->nama_matakuliah ?? '-') .
                        ' di kelas ' . $jadwalDosen->kelas .
                        ' pada hari ' . $request->hari .
                        ' jam ' . $request->jam . '.'
            ])->withInput();
        }

        $validated['jam'] = '2026-06-30 ' . $validated['jam'] . ':00';

        Jadwal::create($validated);

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil ditambahkan!');
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
        $data['jadwal'] = Jadwal::findOrFail($id);
        $data['matakuliah'] = Matakuliah::all();
        $data['dosen'] = Dosen::all();
        return view('pages.jadwal.create-jadwal', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'kode_matakuliah' => 'required|exists:matakuliah,kode_matakuliah',
            'nidn'            => 'required|exists:dosen,nidn',
            'kelas'           => 'required|in:A,B,C,D,E,F',
            'hari'            => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam'             => 'required|date_format:H:i',
        ]);

       $konflikKelas = Jadwal::where('hari', $request->hari)
            ->where('kelas', $request->kelas)
            ->where('jam', '2026-06-30 ' . $request->jam . ':00')
            ->where('id', '!=', $id)
            ->exists();

        if ($konflikKelas) {
            return back()->withErrors([
                'jam' => 'Kelas ' . $request->kelas . ' pada hari ' . $request->hari .
                        ' jam ' . $request->jam . ' sudah ada jadwal lain.'
            ])->withInput();
        }

         $konflikDosen = Jadwal::where('nidn', $request->nidn)
            ->where('hari', $request->hari)
            ->where('jam', '2026-06-30 ' . $request->jam . ':00')
            ->where('id', '!=', $id)
            ->exists();

        if ($konflikDosen) {
            $jadwalDosen = Jadwal::with('matakuliah')
                ->where('nidn', $request->nidn)
                ->where('hari', $request->hari)
                ->where('jam', '2026-06-30 ' . $request->jam . ':00')
                ->where('id', '!=', $id)
                ->first();

            return back()->withErrors([
                'nidn' => 'Dosen ini sudah mengajar ' .
                        ($jadwalDosen->matakuliah->nama_matakuliah ?? '-') .
                        ' di kelas ' . $jadwalDosen->kelas .
                        ' pada hari ' . $request->hari .
                        ' jam ' . $request->jam . '.'
            ])->withInput();
        }


        $validated['jam'] = '2000-01-01 ' . $validated['jam'] . ':00';

        Jadwal::where('id', $id)->update($validated);

        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil dirubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil dihapus!');
    }
}