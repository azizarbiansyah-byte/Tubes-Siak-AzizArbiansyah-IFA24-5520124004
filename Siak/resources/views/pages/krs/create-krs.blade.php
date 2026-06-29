@extends('layouts.main')

@section('title', 'Ambil Mata Kuliah')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Ambil Mata Kuliah</h4>
    <a href="{{ route('krs.index') }}" class="btn btn-secondary">← Kembali</a>
</div>

<div class="card shadow-sm">
    <div class="card-body">
        <form action="{{ route('krs.store') }}" method="POST">
            @csrf

            <div class="alert {{ $totalSks >= 24 ? 'alert-danger' : ($totalSks >= 20 ? 'alert-warning' : 'alert-info') }} mb-3">
                <strong>Total SKS saat ini: {{ $totalSks }} / {{ $maxSks }} SKS</strong>
                @if($totalSks == 24)
                    — Batas maksimal SKS tercapai, tidak dapat menambah mata kuliah.
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                <select name="kode_matakuliah"
                        class="form-select select2 @error('kode_matakuliah') is-invalid @enderror">
                    <option value="">-- Pilih Mata Kuliah --</option>
                    @forelse($matakuliah as $mk)
                        <option value="{{ $mk->kode_matakuliah }}">
                            {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                        </option>
                    @empty
                        <option disabled>Semua mata kuliah sudah diambil</option>
                    @endforelse
                </select>
                @error('kode_matakuliah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                @if(count($matakuliah) > 0 && $totalSks < 24)
                    <button type="submit" class="btn btn-primary">Ambil Mata Kuliah</button>
                @endif
                <a href="{{ route('krs.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </form>
    </div>
</div>

@endsection