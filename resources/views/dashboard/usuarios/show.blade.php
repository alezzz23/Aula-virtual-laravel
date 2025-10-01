@extends('layouts.app')

@section('title', 'Ver Usuario')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('usuarios.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Perfil de Usuario
        </h1>
        <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Editar
        </a>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body text-center">
                    <img src="{{ asset('img/user.png') }}" alt="Avatar" class="rounded-circle" width="150">
                    <h4 class="mt-3">{{ $usuario->namefull }}</h4>
                    <p class="text-muted">{{ $usuario->role->descripcion }}</p>
                    @if($usuario->estado == 'Activo')
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Inactivo</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Información Personal</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Usuario:</th>
                            <td>{{ $usuario->usuario }}</td>
                        </tr>
                        <tr>
                            <th>Nombre Completo:</th>
                            <td>{{ $usuario->namefull }}</td>
                        </tr>
                        <tr>
                            <th>Cédula:</th>
                            <td>{{ $usuario->cedula }}</td>
                        </tr>
                        <tr>
                            <th>Sexo:</th>
                            <td>{{ $usuario->sexo == 'M' ? 'Masculino' : 'Femenino' }}</td>
                        </tr>
                        <tr>
                            <th>Fecha de Nacimiento:</th>
                            <td>{{ $usuario->fecha_nacimiento?->format('d/m/Y') ?? 'No registrada' }}</td>
                        </tr>
                        <tr>
                            <th>Correo:</th>
                            <td>{{ $usuario->correo }}</td>
                        </tr>
                        <tr>
                            <th>Teléfono:</th>
                            <td>{{ $usuario->telefono ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Rol:</th>
                            <td><span class="badge bg-primary">{{ $usuario->role->descripcion }}</span></td>
                        </tr>
                        @if($usuario->isEstudiante() && $usuario->seccion)
                            <tr>
                                <th>Curso/Sección:</th>
                                <td>{{ $usuario->curso->seccion }}</td>
                            </tr>
                        @endif
                        <tr>
                            <th>Permisos:</th>
                            <td>
                                @if($usuario->enviar_tareas)
                                    <span class="badge bg-success me-1">Puede enviar tareas</span>
                                @endif
                                @if($usuario->ver_notas)
                                    <span class="badge bg-info me-1">Puede ver notas</span>
                                @endif
                                @if($usuario->guia)
                                    <span class="badge bg-warning">Profesor guía</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Registrado:</th>
                            <td>{{ $usuario->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            @if($usuario->isEstudiante())
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">Accesos Rápidos</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @if($usuario->ver_notas)
                                <div class="col-md-6 mb-2">
                                    <a href="{{ route('usuarios.boleta', $usuario) }}" class="btn btn-primary w-100">
                                        <i class="fas fa-file-alt"></i> Ver Boleta de Notas
                                    </a>
                                </div>
                            @endif
                            <div class="col-md-6 mb-2">
                                <a href="{{ route('usuarios.asistencia', $usuario) }}" class="btn btn-info w-100">
                                    <i class="fas fa-calendar-check"></i> Ver Asistencia
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

