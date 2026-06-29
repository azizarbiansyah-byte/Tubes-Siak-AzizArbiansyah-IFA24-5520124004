@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">
            <h4>Selamat datang, {{ Auth::user()->name }}!</h4>
            <p class="text-muted">
                Role: <span class="badge bg-primary">{{ Auth::user()->getRoleNames()->first() }}</span>
            </p>
        </div>
    </div>
@endsection
