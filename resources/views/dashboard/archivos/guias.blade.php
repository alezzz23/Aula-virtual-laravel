@extends('layouts.app')

@section('title', 'Guías - ' . $materia->materia)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.show', $materia) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Guías - {{ $materia->materia }}
        </h1>
        @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#subirGuiaModal">
                <i class="fas fa-upload"></i> Subir Guía
            </button>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse($guias as $guia)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-book fa-3x text-warning me-3"></i>
                                    <div>
                                        <h6 class="mb-1">{{ $guia->nombre }}</h6>
                                        <small class="text-muted">{{ $guia->created_at->format('d/m/Y') }}</small>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ asset('storage/' . $guia->archivo) }}" target="_blank" class="btn btn-sm btn-primary w-100 mb-1">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ asset('storage/' . $guia->archivo) }}" download class="btn btn-sm btn-success w-100 mb-1">
                                        <i class="fas fa-download"></i> Descargar
                                    </a>
                                    @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
                                        <form action="{{ route('guias.destroy', $guia) }}" method="POST" 
                                              onsubmit="return confirm('¿Eliminar esta guía?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger w-100">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No hay guías disponibles.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="subirGuiaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('materias.guias.store', $materia) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Subir Guía</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Archivo *</label>
                        <input type="file" class="form-control" name="archivo" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Subir</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

