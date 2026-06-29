<?php

use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MatakuliahController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
return view('auth.login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

    Route::middleware(['role:Admin'])->group(function () {

        Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');
        Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
        Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');

        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
        Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');

        Route::get('/matakuliah', [MatakuliahController::class, 'index'])->name('matakuliah.index');
        Route::get('/matakuliah/create', [MatakuliahController::class, 'create'])->name('matakuliah.create');
        Route::post('/matakuliah', [MatakuliahController::class, 'store'])->name('matakuliah.store');

        Route::get('/jadwal/create', [JadwalController::class, 'create'])->name('jadwal.create');
        Route::post('/jadwal', [JadwalController::class, 'store'])->name('jadwal.store');
        Route::get('/jadwal/{id}/edit', [JadwalController::class, 'edit'])->name('jadwal.edit');
        Route::patch('/jadwal/{id}', [JadwalController::class, 'update'])->name('jadwal.update');
        Route::delete('/jadwal/{id}', [JadwalController::class, 'destroy'])->name('jadwal.destroy');

        Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
        Route::patch('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
        Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');

        Route::get('/mahasiswa/{id}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::patch('/mahasiswa/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/mahasiswa/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');

        Route::get('/matakuliah/{id}/edit', [MatakuliahController::class, 'edit'])->name('matakuliah.edit');
        Route::patch('/matakuliah/{id}', [MatakuliahController::class, 'update'])->name('matakuliah.update');
        Route::delete('/matakuliah/{id}', [MatakuliahController::class, 'destroy'])->name('matakuliah.destroy');

    });

    Route::middleware(['role:Mahasiswa'])->group(function () {

        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
        Route::get('/krs/create', [KrsController::class, 'create'])->name('krs.create');
        Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
        Route::get('/krs/print', [KrsController::class, 'print'])->name('krs.print');
        Route::get('/krs/export', [KrsController::class, 'export'])->name('krs.export');
        
        
        Route::delete('/krs/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');
    });

});



require __DIR__.'/auth.php';