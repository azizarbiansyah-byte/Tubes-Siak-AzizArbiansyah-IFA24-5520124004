    <!DOCTYPE html>
    <html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SIAKAD @yield('title')</title>

        {{-- Bootstrap CSS --}}
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

        {{-- Select2 --}}
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
        <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet"/>

        @stack('styles')
    </head>
    <body class="bg-light">

        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">SIAKAD</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        @role('Admin')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dosen.*') ? 'active fw-semibold' : '' }}"
                            href="{{ route('dosen.index') }}">Dosen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('mahasiswa.*') ? 'active fw-semibold' : '' }}"
                            href="{{ route('mahasiswa.index') }}">Mahasiswa</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('matakuliah.*') ? 'active fw-semibold' : '' }}"
                            href="{{ route('matakuliah.index') }}">Mata Kuliah</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('jadwal.*') ? 'active fw-semibold' : '' }}"
                            href="{{ route('jadwal.index') }}">Jadwal</a>
                        </li>
                        @endrole

                        @role('Mahasiswa')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('krs.*') ? 'active fw-semibold' : '' }}"
                            href="{{ route('krs.index') }}">KRS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('jadwal.*') ? 'active fw-semibold' : '' }}"
                            href="{{ route('jadwal.index') }}">Jadwal</a>
                        </li>
                        @endrole

                    </ul>

                    <div class="d-flex align-items-center gap-3">
                        <span class="text-white small">
                            {{ Auth::user()->name }}
                            <span class="badge bg-warning text-dark ms-1">
                                {{ Auth::user()->getRoleNames()->first() }}
                            </span>
                        </span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-light">Logout</button>
                        </form>
                    </div>

                </div>
            </div>
        </nav>

        <div class="container py-4">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')

        </div>

        {{-- Bootstrap JS --}}
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        {{-- jQuery + Select2 --}}
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                $('.select2').select2({
                    theme: 'bootstrap-5',
                    placeholder: 'Cari...',
                    allowClear: true
                });
            });
        </script>

        @stack('scripts')

    </body>
    </html>