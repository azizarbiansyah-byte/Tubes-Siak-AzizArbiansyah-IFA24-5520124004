@extends('layouts.main')

@section('title', isset($dosen) ? 'Edit Dosen' : 'Tambah Dosen')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">{{ isset($dosen) ? 'Edit Dosen' : 'Tambah Dosen' }}</h4>
    <a href="{{ route('dosen.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ isset($dosen) ? route('dosen.update', $dosen->nidn) : route('dosen.store') }}"
              method="POST">
            @csrf
            @if(isset($dosen))
                @method('PATCH')
            @endif

            <div class="mb-3">
                <label class="form-label">NIDN <span class="text-danger">*</span></label>
                <input type="text"
                       name="nidn"
                       value="{{ old('nidn', $dosen->nidn ?? '') }}"
                       class="form-control @error('nidn') is-invalid @enderror"
                       placeholder="Masukkan NIDN (10 digit)"
                       {{ isset($dosen) ? 'readonly' : '' }}>
                @error('nidn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if(isset($dosen))
                    <small class="text-muted">NIDN tidak dapat diubah.</small>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Dosen <span class="text-danger">*</span></label>
                <input type="text"
                       name="nama"
                       value="{{ old('nama', $dosen->nama ?? '') }}"
                       class="form-control @error('nama') is-invalid @enderror"
                       placeholder="Masukkan nama lengkap dosen">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ isset($dosen) ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('dosen.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection