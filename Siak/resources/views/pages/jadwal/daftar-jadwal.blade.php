@extends('layouts.main')

@section('title', 'Data Jadwal')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Jadwal Perkuliahan</h4>
    @role('Admin')
    <a href="{{ route('jadwal.create') }}" class="btn btn-primary">+ Tambah Jadwal</a>
    @endrole
</div>

<form method="GET" action="{{ route('jadwal.index') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="keyword" value="{{ request('keyword') }}"
               class="form-control" placeholder="Cari nama dosen, mata kuliah, hari, atau kelas...">
        <button type="submit" class="btn btn-outline-primary">Cari</button>
        @if(request('keyword'))
            <a href="{{ route('jadwal.index') }}" class="btn btn-outline-secondary">Reset</a>
        @endif
    </div>
</form>

<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-bordered table-hover table-striped mb-0">
            <thead class="table-primary">
                <tr>
                    <th width="60" class="text-center">No</th>
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th width="70">Kelas</th>
                    <th width="100">Hari</th>
                    <th width="80">Jam</th>
                    @role('Admin')
                    <th width="150">Aksi</th>
                    @endrole
                </tr>
            </thead>
            <tbody>
                @forelse($jadwal as $index => $j)
                <tr>
                    <td class="text-center">{{ $jadwal->firstItem() + $index }}</td>
                    <td>{{ $j->matakuliah->nama_matakuliah ?? '-' }}</td>
                    <td>{{ $j->dosen->nama ?? '-' }}</td>
                    <td class="text-center">{{ $j->kelas }}</td>
                    <td>{{ $j->hari }}</td>
                    <td>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</td>
                    @role('Admin')
                    <td>
                        <a href="{{ route('jadwal.edit', $j->id) }}"
                           class="btn btn-sm btn-warning">Edit</a>

                        <button type="button" class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#hapus{{ $j->id }}">
                            Hapus
                        </button>
                    </td>
                    @endrole
                </tr>

                @role('Admin')
                <div class="modal fade" id="hapus{{ $j->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('jadwal.destroy', $j->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Hapus Jadwal</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    Jadwal <strong>{{ $j->matakuliah->nama_matakuliah ?? '-' }}</strong>
                                    kelas <strong>{{ $j->kelas }}</strong>
                                    hari <strong>{{ $j->hari }}</strong>
                                    jam <strong>{{ \Carbon\Carbon::parse($j->jam)->format('H:i') }}</strong>
                                    akan dihapus.
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
                @endrole

                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        @if(request('keyword'))
                            Tidak ada jadwal dengan keyword "{{ request('keyword') }}"
                        @else
                            Belum ada data jadwal.
                        @endif
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Pagination --}}
<div class="mt-3 d-flex justify-content-end">
    {{ $jadwal->links() }}
</div>

@endsection