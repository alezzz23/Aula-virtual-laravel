@php
    $config = \App\Models\Personalizar::latest()->first() ?? new \App\Models\Personalizar(['colegio' => 'Aula Virtual', 'logo' => 'img/logo.png', 'color' => '#00704f']);
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ $config->colegio ?? 'Aula Virtual' }} - @yield('title')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    
    <style>
        :root {
            --primary-color: {{ $config->color ?? '#00704f' }};
        }
        
        .bg-primary {
            background-color: var(--primary-color) !important;
        }
        
        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }
        
        .btn-primary:hover {
            opacity: 0.9;
        }
        
        .sidebar {
            min-height: 100vh;
            background-color: var(--primary-color);
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,.8);
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255,255,255,.1);
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo" height="40" class="d-inline-block align-text-top me-2" onerror="this.src='{{ asset('img/logo.png') }}'">
                {{ $config->colegio }}
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> {{ auth()->user()->usuario }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('usuarios.show', auth()->id()) }}">Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
            <nav class="col-md-2 d-md-block sidebar collapse" id="sidebar">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i> Inicio
                            </a>
                        </li>
                        
                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('usuarios.*') || request()->routeIs('estudiantes.*') || request()->routeIs('profesores.*') ? 'active' : '' }}" href="{{ route('usuarios.index') }}">
                                    <i class="fas fa-users"></i> Usuarios
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('cursos.*') ? 'active' : '' }}" href="{{ route('cursos.index') }}">
                                    <i class="fas fa-school"></i> Cursos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('materias.*') ? 'active' : '' }}" href="{{ route('materias.index') }}">
                                    <i class="fas fa-book"></i> Materias
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('eventos.*') ? 'active' : '' }}" href="{{ route('eventos.index') }}">
                                    <i class="fas fa-calendar"></i> Eventos
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('personalizar.*') ? 'active' : '' }}" href="{{ route('personalizar.index') }}">
                                    <i class="fas fa-cog"></i> Configuración
                                </a>
                            </li>
                        @endif
                        
                        @if(auth()->user()->isProfesor() || auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('asistencia.*') ? 'active' : '' }}" href="{{ route('asistencia.index') }}">
                                    <i class="fas fa-clipboard-check"></i> Asistencia
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('notas.*') ? 'active' : '' }}" href="{{ route('notas.index') }}">
                                    <i class="fas fa-graduation-cap"></i> Notas
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('tareas.*') ? 'active' : '' }}" href="{{ route('tareas.index') }}">
                                    <i class="fas fa-tasks"></i> Tareas
                                </a>
                            </li>
                        @endif
                        
                        @if(auth()->user()->isEstudiante())
                            @if(auth()->user()->ver_notas)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('usuarios.boleta', auth()->id()) }}">
                                    <i class="fas fa-file-alt"></i> Mis Notas
                                </a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('usuarios.asistencia', auth()->id()) }}">
                                    <i class="fas fa-calendar-check"></i> Mi Asistencia
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
            @endauth

            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
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
            </main>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>

