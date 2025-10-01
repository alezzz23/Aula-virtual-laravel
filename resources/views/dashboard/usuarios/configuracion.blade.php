@extends('layouts.app')

@section('title', 'Mi Configuración')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Modificar Mi Usuario
        </h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('usuarios.configuracion.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nombre de Usuario</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->usuario }}" disabled>
                    <small class="text-muted">El nombre de usuario no puede ser modificado</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nueva Contraseña</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           name="password" placeholder="Dejar vacío para no cambiar">
                    <small class="text-muted">Dejar vacío si no deseas cambiar tu contraseña</small>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Correo Electrónico *</label>
                    <input type="email" class="form-control @error('correo') is-invalid @enderror" 
                           name="correo" value="{{ old('correo', auth()->user()->correo) }}" required>
                    @error('correo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Teléfono *</label>
                    <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                           name="telefono" value="{{ old('telefono', auth()->user()->telefono) }}" required>
                    @error('telefono')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="reset" class="btn btn-secondary me-2">
                        <i class="fas fa-undo"></i> Restaurar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

