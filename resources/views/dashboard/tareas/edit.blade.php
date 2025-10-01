@extends('layouts.app')

@section('title', 'Editar Tarea')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('tareas.show', $tarea) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Editar Tarea
        </h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('tareas.update', $tarea) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Título de la Tarea *</label>
                    <input type="text" class="form-control @error('tarea') is-invalid @enderror" 
                           name="tarea" value="{{ old('tarea', $tarea->tarea) }}" required>
                    @error('tarea')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Descripción</label>
                    <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                              name="descripcion" rows="4">{{ old('descripcion', $tarea->descripcion) }}</textarea>
                    @error('descripcion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Materia *</label>
                            <select class="form-select @error('idMa') is-invalid @enderror" name="idMa" required>
                                <option value="">Seleccione una materia...</option>
                                @foreach($materias as $materia)
                                    <option value="{{ $materia->id }}" {{ old('idMa', $tarea->idMa) == $materia->id ? 'selected' : '' }}>
                                        {{ $materia->materia }} - {{ $materia->curso->seccion ?? '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idMa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Lapso *</label>
                            <select class="form-select @error('lapso') is-invalid @enderror" name="lapso">
                                <option value="1er Lapso" {{ old('lapso', $tarea->lapso) == '1er Lapso' ? 'selected' : '' }}>1er Lapso</option>
                                <option value="2do Lapso" {{ old('lapso', $tarea->lapso) == '2do Lapso' ? 'selected' : '' }}>2do Lapso</option>
                                <option value="3er Lapso" {{ old('lapso', $tarea->lapso) == '3er Lapso' ? 'selected' : '' }}>3er Lapso</option>
                            </select>
                            @error('lapso')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de Entrega</label>
                    <input type="date" class="form-control @error('fecha_entrega') is-invalid @enderror" 
                           name="fecha_entrega" value="{{ old('fecha_entrega', $tarea->fecha_entrega ? \Carbon\Carbon::parse($tarea->fecha_entrega)->format('Y-m-d') : '') }}">
                    @error('fecha_entrega')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Nuevo Archivo Adjunto</label>
                    <input type="file" class="form-control @error('archivo') is-invalid @enderror" name="archivo">
                    <small class="text-muted">Opcional: Dejar vacío para mantener el archivo actual</small>
                    @if($tarea->archivo)
                        <br><small class="text-info">Archivo actual: {{ $tarea->archivo }}</small>
                    @endif
                    @error('archivo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('tareas.show', $tarea) }}" class="btn btn-secondary me-2">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Tarea
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

