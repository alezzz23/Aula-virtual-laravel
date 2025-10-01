@extends('layouts.app')

@section('title', 'Clases - ' . $materia->materia)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.show', $materia) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Clases - {{ $materia->materia }}
        </h1>
        @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#subirClaseModal">
                <i class="fas fa-upload"></i> Subir Clase
            </button>
        @endif
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-file-pdf"></i> Archivos de Clases</h5>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse($clases as $clase)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-file-pdf fa-3x text-danger me-3"></i>
                                    <div>
                                        <h6 class="mb-1">{{ $clase->nombre }}</h6>
                                        <small class="text-muted">
                                            {{ \Carbon\Carbon::parse($clase->created_at)->format('d/m/Y') }}
                                        </small>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ asset('storage/' . $clase->archivo) }}" target="_blank" class="btn btn-sm btn-primary w-100 mb-1">
                                        <i class="fas fa-eye"></i> Ver
                                    </a>
                                    <a href="{{ asset('storage/' . $clase->archivo) }}" download class="btn btn-sm btn-success w-100 mb-1">
                                        <i class="fas fa-download"></i> Descargar
                                    </a>
                                    @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
                                        <form action="{{ route('clases.destroy', $clase) }}" method="POST" 
                                              onsubmit="return confirm('¿Eliminar este archivo?')">
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
                            <i class="fas fa-info-circle"></i> No hay clases disponibles.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<!-- Modal Subir Clase -->
<div class="modal fade" id="subirClaseModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('materias.clases.store', $materia) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Subir Nueva Clase</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre del Archivo *</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Archivo *</label>
                        <input type="file" class="form-control" name="archivo" required>
                        <small class="text-muted">Formatos permitidos: PDF, DOC, DOCX, PPT, PPTX</small>
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

