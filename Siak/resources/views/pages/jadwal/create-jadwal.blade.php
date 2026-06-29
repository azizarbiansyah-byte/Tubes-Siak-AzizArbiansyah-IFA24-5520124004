    @extends('layouts.main')

    @section('title', isset($jadwal) ? 'Edit Jadwal' : 'Tambah Jadwal')

    @section('content')

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">{{ isset($jadwal) ? 'Edit Jadwal' : 'Tambah Jadwal' }}</h4>
            <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">← Kembali</a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ isset($jadwal) ? route('jadwal.update', $jadwal->id) : route('jadwal.store') }}"
                    method="POST">
                    @csrf
                    @if (isset($jadwal))
                        @method('PATCH')
                    @endif

                    <div class="mb-3">
                        <label class="form-label">Mata Kuliah <span class="text-danger">*</span></label>
                        <select name="kode_matakuliah"
                            class="form-select select2 @error('kode_matakuliah') is-invalid @enderror">
                            <option value="">-- Pilih Mata Kuliah --</option>
                            @foreach ($matakuliah as $mk)
                                <option value="{{ $mk->kode_matakuliah }}"
                                    {{ old('kode_matakuliah', $jadwal->kode_matakuliah ?? '') == $mk->kode_matakuliah ? 'selected' : '' }}>
                                    {{ $mk->kode_matakuliah }} - {{ $mk->nama_matakuliah }} ({{ $mk->sks }} SKS)
                                </option>
                            @endforeach
                        </select>
                        @error('kode_matakuliah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Dosen Pengajar <span class="text-danger">*</span></label>
                        <select name="nidn" class="form-select select2 @error('nidn') is-invalid @enderror">
                            <option value="">-- Pilih Dosen --</option>
                            @foreach ($dosen as $d)
                                <option value="{{ $d->nidn }}"
                                    {{ old('nidn', $jadwal->nidn ?? '') == $d->nidn ? 'selected' : '' }}>
                                    {{ $d->nidn }} - {{ $d->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('nidn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Kelas <span class="text-danger">*</span></label>
                        <select name="kelas" class="form-select @error('kelas') is-invalid @enderror">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach (['A', 'B', 'C', 'D', 'E'] as $kelas)
                                <option value="{{ $kelas }}"
                                    {{ old('kelas', $jadwal->kelas ?? '') == $kelas ? 'selected' : '' }}>
                                    Kelas {{ $kelas }}
                                </option>
                            @endforeach
                        </select>
                        @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hari <span class="text-danger">*</span></label>
                        <select name="hari" class="form-select @error('hari') is-invalid @enderror">
                            <option value="">-- Pilih Hari --</option>
                            @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                <option value="{{ $hari }}"
                                    {{ old('hari', $jadwal->hari ?? '') == $hari ? 'selected' : '' }}>
                                    {{ $hari }}
                                </option>
                            @endforeach
                        </select>
                        @error('hari')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jam Mulai <span class="text-danger">*</span></label>
                        <select name="jam" class="form-select @error('jam') is-invalid @enderror">
                            <option value="">-- Pilih Jam --</option>
                            @php
                                $slots = ['08:00', '10:30', '13:00', '15:30', '18:30'];
                            @endphp
                            @foreach ($slots as $slot)
                                <option value="{{ $slot }}"
                                    {{ old('jam', isset($jadwal) ? \Carbon\Carbon::parse($jadwal->jam)->format('H:i') : '') == $slot ? 'selected' : '' }}>
                                    {{ $slot }}
                                </option>
                            @endforeach
                        </select>
                        @error('jam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($jadwal) ? 'Update' : 'Simpan' }}
                        </button>
                        <a href="{{ route('jadwal.index') }}" class="btn btn-secondary">Batal</a>
                    </div>

                </form>
            </div>
        </div>

    @endsection
