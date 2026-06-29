@extends('layouts.main')

@section('title', isset($matakuliah) ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">{{ isset($matakuliah) ? 'Edit Mata Kuliah' : 'Tambah Mata Kuliah' }}</h4>
    <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ isset($matakuliah) ? route('matakuliah.update', $matakuliah->kode_matakuliah) : route('matakuliah.store') }}"
              method="POST">
            @csrf
            @if(isset($matakuliah))
                @method('PATCH')
            @endif

            <div class="mb-3">
                <label class="form-label">Kode Mata Kuliah <span class="text-danger">*</span></label>
                <input type="text"
                       name="kode_matakuliah"
                       value="{{ old('kode_matakuliah', $matakuliah->kode_matakuliah ?? '') }}"
                       class="form-control @error('kode_matakuliah') is-invalid @enderror"
                       placeholder="Masukkan kode mata kuliah"
                       {{ isset($matakuliah) ? 'readonly' : '' }}>
                @error('kode_matakuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if(isset($matakuliah))
                    <small class="text-muted">Kode mata kuliah tidak dapat diubah.</small>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Mata Kuliah <span class="text-danger">*</span></label>
                <input type="text"
                       name="nama_matakuliah"
                       value="{{ old('nama_matakuliah', $matakuliah->nama_matakuliah ?? '') }}"
                       class="form-control @error('nama_matakuliah') is-invalid @enderror"
                       placeholder="Masukkan nama mata kuliah">
                @error('nama_matakuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">SKS <span class="text-danger">*</span></label>
                <select name="sks"
                        class="form-select @error('sks') is-invalid @enderror">
                    <option value="">-- Pilih SKS --</option>
                    @foreach([1,2,3,4,5,6] as $sks)
                        <option value="{{ $sks }}"
                            {{ old('sks', $matakuliah->sks ?? '') == $sks ? 'selected' : '' }}>
                            {{ $sks }} SKS
                        </option>
                    @endforeach
                </select>
                @error('sks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    {{ isset($matakuliah) ? 'Update' : 'Simpan' }}
                </button>
                <a href="{{ route('matakuliah.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection