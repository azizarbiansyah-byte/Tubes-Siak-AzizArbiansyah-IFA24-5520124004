@extends('layouts.main')

@section('title', 'KRS')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Kartu Rencana Studi (KRS)</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('krs.create') }}" class="btn btn-primary">+ Ambil Mata Kuliah</a>
        <a href="{{ route('krs.export') }}" class="btn btn-danger" target="_blank">Export PDF</a>
    </div>
</div>

<div class="card shadow-sm mb-3">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <strong>Nama:</strong> {{ Auth::user()->name }}
            </div>
            <div class="col-md-6">
                <strong>NPM:</strong> {{ Auth::user()->npm }}
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered table-hover table-striped mb-0">
            <thead class="table-primary">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th width="80" class="text-center">SKS</th>
                    <th width="120" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($krs as $index => $k)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $k->kode_matakuliah }}</td>
                    <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td class="text-center">{{ $k->matakuliah->sks ?? '-' }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#hapus{{ $k->id }}">
                            Drop
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="hapus{{ $k->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('krs.destroy', $k->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Drop Mata Kuliah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Mata kuliah <strong>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</strong>
                                    akan di-drop dari KRS kamu.
                                    Tindakan ini tidak dapat dibatalkan.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Ya, Drop</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Belum ada mata kuliah yang diambil.
                        <a href="{{ route('krs.create') }}">Ambil sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
            @if(count($krs) > 0)
            <tfoot class="table-light">
                <tr>
                    <td colspan="3" class="text-end fw-semibold">Total SKS:</td>
                    <td class="text-center fw-semibold">
                        {{ $krs->sum(fn($k) => $k->matakuliah->sks ?? 0) }}
                    </td>
                    <td></td>
                </tr>
            </tfoot>
            @endif
        </table>
    </div>
</div>

@endsection