@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('usuarios.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Editar Usuario: {{ $usuario->namefull }}
        </h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('usuarios.update', $usuario) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Nombre de Usuario *</label>
                            <input type="text" class="form-control @error('usuario') is-invalid @enderror" 
                                   id="usuario" name="usuario" value="{{ old('usuario', $usuario->usuario) }}" required>
                            @error('usuario')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="namefull" class="form-label">Nombre Completo *</label>
                            <input type="text" class="form-control @error('namefull') is-invalid @enderror" 
                                   id="namefull" name="namefull" value="{{ old('namefull', $usuario->namefull) }}" required>
                            @error('namefull')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="cedula" class="form-label">Cédula *</label>
                            <input type="text" class="form-control @error('cedula') is-invalid @enderror" 
                                   id="cedula" name="cedula" value="{{ old('cedula', $usuario->cedula) }}" required>
                            @error('cedula')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="sexo" class="form-label">Sexo *</label>
                            <select class="form-select @error('sexo') is-invalid @enderror" 
                                    id="sexo" name="sexo" required>
                                <option value="M" {{ old('sexo', $usuario->sexo) == 'M' ? 'selected' : '' }}>Masculino</option>
                                <option value="F" {{ old('sexo', $usuario->sexo) == 'F' ? 'selected' : '' }}>Femenino</option>
                            </select>
                            @error('sexo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                            <input type="date" class="form-control @error('fecha_nacimiento') is-invalid @enderror" 
                                   id="fecha_nacimiento" name="fecha_nacimiento" 
                                   value="{{ old('fecha_nacimiento', $usuario->fecha_nacimiento?->format('Y-m-d')) }}">
                            @error('fecha_nacimiento')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="password" class="form-label">Nueva Contraseña (dejar en blanco para mantener)</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                   id="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico *</label>
                            <input type="email" class="form-control @error('correo') is-invalid @enderror" 
                                   id="correo" name="correo" value="{{ old('correo', $usuario->correo) }}" required>
                            @error('correo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono *</label>
                            <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                                   id="telefono" name="telefono" value="{{ old('telefono', $usuario->telefono) }}" required>
                            @error('telefono')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="idRol" class="form-label">Rol *</label>
                            <select class="form-select @error('idRol') is-invalid @enderror" 
                                    id="idRol" name="idRol" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ old('idRol', $usuario->idRol) == $role->id ? 'selected' : '' }}>
                                        {{ $role->descripcion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idRol')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6" id="seccionDiv" style="display: {{ old('idRol', $usuario->idRol) == 3 ? 'block' : 'none' }};">
                        <div class="mb-3">
                            <label for="seccion" class="form-label">Curso/Sección</label>
                            <select class="form-select @error('seccion') is-invalid @enderror" 
                                    id="seccion" name="seccion">
                                <option value="">Sin asignar</option>
                                @foreach($cursos as $curso)
                                    <option value="{{ $curso->id }}" {{ old('seccion', $usuario->seccion) == $curso->id ? 'selected' : '' }}>
                                        {{ $curso->seccion }}
                                    </option>
                                @endforeach
                            </select>
                            @error('seccion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="enviar_tareas" 
                                       name="enviar_tareas" value="1" {{ old('enviar_tareas', $usuario->enviar_tareas) ? 'checked' : '' }}>
                                <label class="form-check-label" for="enviar_tareas">
                                    Puede enviar tareas
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="ver_notas" 
                                       name="ver_notas" value="1" {{ old('ver_notas', $usuario->ver_notas) ? 'checked' : '' }}>
                                <label class="form-check-label" for="ver_notas">
                                    Puede ver notas
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="guia" 
                                       name="guia" value="1" {{ old('guia', $usuario->guia) ? 'checked' : '' }}>
                                <label class="form-check-label" for="guia">
                                    Es profesor guía
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado *</label>
                    <select class="form-select @error('estado') is-invalid @enderror" 
                            id="estado" name="estado" required>
                        <option value="Activo" {{ old('estado', $usuario->estado) == 'Activo' ? 'selected' : '' }}>Activo</option>
                        <option value="Inactivo" {{ old('estado', $usuario->estado) == 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('idRol').addEventListener('change', function() {
        var seccionDiv = document.getElementById('seccionDiv');
        if (this.value == '3') {
            seccionDiv.style.display = 'block';
        } else {
            seccionDiv.style.display = 'none';
        }
    });
</script>
@endpush
@endsection

