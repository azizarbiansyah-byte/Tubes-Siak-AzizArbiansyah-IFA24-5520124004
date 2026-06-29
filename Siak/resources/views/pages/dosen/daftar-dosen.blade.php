@extends('layouts.main')

@section('title', 'Data Dosen')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Dosen</h4>
    <a href="{{ route('dosen.create') }}" class="btn btn-primary">+ Tambah Dosen</a>
</div>

<form method="GET" action="{{ route('dosen.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="keyword" value="{{ request('keyword') }}"
               class="form-control" placeholder="Cari NIDN atau nama dosen...">
        <button type="submit" class="btn btn-outline-primary">Cari</button>
        @if(request('keyword'))
            <a href="{{ route('dosen.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead class="table-primary">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>NIDN</th>
                    <th>Nama Dosen</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dosen as $index => $d)
                <tr>
                    <td class="text-center">{{ $dosen->firstItem() + $index }}</td>
                    <td>{{ $d->nidn }}</td>
                    <td>{{ $d->nama }}</td>
                    <td>
                        <a href="{{ route('dosen.edit', $d->nidn) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <button type="button" class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#hapus{{ $d->nidn }}">
                            Hapus
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="hapus{{ $d->nidn }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('dosen.destroy', $d->nidn) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Data Dosen</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Dosen <strong>{{ $d->nama }}</strong> ({{ $d->nidn }}) akan dihapus.
                                    Apakah anda yakin?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-4">
                        @if(request('keyword'))
                            Tidak ada dosen dengan keyword "{{ request('keyword') }}"
                        @else
                            Belum ada data dosen.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3 d-flex justify-content-end">
    {{ $dosen->links() }}
</div>

@endsection