@extends('layouts.main')

@section('title', 'Data Mata Kuliah')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Mata Kuliah</h4>
    <a href="{{ route('matakuliah.create') }}" class="btn btn-primary">+ Tambah Mata Kuliah</a>
</div>

<form method="GET" action="{{ route('matakuliah.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="keyword" value="{{ request('keyword') }}"
               class="form-control" placeholder="Cari kode, nama mata kuliah, atau SKS...">
        <button type="submit" class="btn btn-outline-primary">Cari</button>
        @if(request('keyword'))
            <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered table-hover table-striped mb-0">
            <thead class="table-primary">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>Kode MK</th>
                    <th>Nama Mata Kuliah</th>
                    <th width="80">SKS</th>
                    <th width="150">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($matakuliah as $index => $mk)
                <tr>
                    <td class="text-center">{{ $matakuliah->firstItem() + $index }}</td>
                    <td>{{ $mk->kode_matakuliah }}</td>
                    <td>{{ $mk->nama_matakuliah }}</td>
                    <td class="text-center">{{ $mk->sks }}</td>
                    <td>
                        <a href="{{ route('matakuliah.edit', $mk->kode_matakuliah) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <button type="button" class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#hapus{{ $mk->kode_matakuliah }}">
                            Hapus
                        </button>
                    </td>
                </tr>

                <div class="modal fade" id="hapus{{ $mk->kode_matakuliah }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('matakuliah.destroy', $mk->kode_matakuliah) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Mata Kuliah</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Mata kuliah <strong>{{ $mk->nama_matakuliah }}</strong>
                                    ({{ $mk->kode_matakuliah }}) akan dihapus.
                                    <div class="alert alert-warning mt-2 mb-0">
                                        <small>Jadwal yang menggunakan mata kuliah ini
                                        tidak bisa dihapus selama masih ada jadwal terkait.</small>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
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
                            Tidak ada mata kuliah dengan keyword "{{ request('keyword') }}"
                        @else
                            Belum ada data mata kuliah.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3 d-flex justify-content-end">
    {{ $matakuliah->links() }}
</div>

@endsection