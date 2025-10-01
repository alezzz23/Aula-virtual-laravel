@extends('layouts.app')

@section('title', 'Editar Materia')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.index') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Editar Materia
        </h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('materias.update', $materia) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="materia" class="form-label">Nombre de la Materia *</label>
                    <input type="text" class="form-control @error('materia') is-invalid @enderror" 
                           id="materia" name="materia" value="{{ old('materia', $materia->materia) }}" required>
                    @error('materia')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="curso" class="form-label">Curso *</label>
                    <select class="form-select @error('curso') is-invalid @enderror" 
                            id="curso" name="curso" required>
                        <option value="">Seleccione un curso...</option>
                        @foreach($cursos as $curso)
                            <option value="{{ $curso->id }}" {{ old('curso', $materia->curso) == $curso->id ? 'selected' : '' }}>
                                {{ $curso->seccion }}
                            </option>
                        @endforeach
                    </select>
                    @error('curso')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="profesor" class="form-label">Profesor *</label>
                    <select class="form-select @error('profesor') is-invalid @enderror" 
                            id="profesor" name="profesor" required>
                        <option value="">Seleccione un profesor...</option>
                        @foreach($profesores as $profesor)
                            <option value="{{ $profesor->id }}" {{ old('profesor', $materia->profesor) == $profesor->id ? 'selected' : '' }}>
                                {{ $profesor->namefull }}
                            </option>
                        @endforeach
                    </select>
                    @error('profesor')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="estado" class="form-label">Estado *</label>
                    <select class="form-select @error('estado') is-invalid @enderror" 
                            id="estado" name="estado" required>
                        <option value="1" {{ old('estado', $materia->estado) == 1 ? 'selected' : '' }}>Activa</option>
                        <option value="0" {{ old('estado', $materia->estado) == 0 ? 'selected' : '' }}>Inactiva</option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('materias.index') }}" class="btn btn-secondary me-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Materia
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

