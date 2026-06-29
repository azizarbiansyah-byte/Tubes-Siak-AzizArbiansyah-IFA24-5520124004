@extends('layouts.main')

@section('title', 'Data Mahasiswa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Mahasiswa</h4>
    <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a>
</div>

<form method="GET" action="{{ route('mahasiswa.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="keyword" value="{{ request('keyword') }}"
               class="form-control" placeholder="Cari NPM, nama, atau dosen wali...">
        <button type="submit" class="btn btn-outline-primary">Cari</button>
        @if(request('keyword'))
            <a href="{{ route('mahasiswa.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered table-hover mb-0">
            <thead class="table-primary">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>NPM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Dosen Wali</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mahasiswa as $index => $m)
                <tr>
                    <td class="text-center">{{ $mahasiswa->firstItem() + $index }}</td>
                    <td>{{ $m->npm }}</td>
                    <td>{{ $m->nama }}</td>
                    <td>{{ $m->dosen->nama ?? '-' }}</td>
                    <td>
                        <a href="{{ route('mahasiswa.edit', $m->npm) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <button type="button" class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#hapus{{ $m->npm }}">
                            Hapus
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="hapus{{ $m->npm }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('mahasiswa.destroy', $m->npm) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Data Mahasiswa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Mahasiswa <strong>{{ $m->nama }}</strong> ({{ $m->npm }}) akan dihapus.
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
                    <td colspan="5" class="text-center text-muted py-4">
                        @if(request('keyword'))
                            Tidak ada mahasiswa dengan keyword "{{ request('keyword') }}"
                        @else
                            Belum ada data mahasiswa.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3 d-flex justify-content-end">
    {{ $mahasiswa->links() }}
</div>

@endsection