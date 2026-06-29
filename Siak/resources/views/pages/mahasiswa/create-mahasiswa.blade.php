@extends('layouts.main')

@section('title', isset($mahasiswa) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">{{ isset($mahasiswa) ? 'Edit Mahasiswa' : 'Tambah Mahasiswa' }}</h4>
    <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ isset($mahasiswa) ? route('mahasiswa.update', $mahasiswa->npm) : route('mahasiswa.store') }}"
              method="POST">
            @csrf
            @if(isset($mahasiswa))
                @method('PATCH')
            @endif

            <div class="mb-3">
                <label class="form-label">NPM <span class="text-danger">*</span></label>
                <input type="text"
                       name="npm"
                       value="{{ old('npm', $mahasiswa->npm ?? '') }}"
                       class="form-control @error('npm') is-invalid @enderror"
                       placeholder="Masukkan NPM (10 digit)"
                       {{ isset($mahasiswa) ? 'readonly' : '' }}>
                @error('npm')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if(isset($mahasiswa))
                    <small class="text-muted">NPM tidak dapat dirubah.</small>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                <input type="text"
                       name="nama"
                       value="{{ old('nama', $mahasiswa->nama ?? '') }}"
                       class="form-control @error('nama') is-invalid @enderror"
                       placeholder="Masukkan nama lengkap mahasiswa">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Dosen Wali <span class="text-danger">*</span></label>
                <select name="nidn"
                        class="form-select select2 @error('nidn') is-invalid @enderror">
                    <option value="">-- Pilih Dosen Wali --</option>
                    @foreach($dosen as $d)
                        <option value="{{ $d->nidn }}"
                            {{ old('nidn', $mahasiswa->nidn ?? '') == $d->nidn ? 'selected' : '' }}>
                            {{ $d->nidn }} - {{ $d->nama }}
                        </option>
                    @endforeach
                </select>
                @error('nidn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ isset($mahasiswa) ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection