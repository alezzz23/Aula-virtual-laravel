@extends('layouts.app')

@section('title', 'Videos - ' . $materia->materia)

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.show', $materia) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Videos - {{ $materia->materia }}
        </h1>
        @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#agregarVideoModal">
                <i class="fas fa-plus"></i> Agregar Video
            </button>
        @endif
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                @forelse($videos as $video)
                    <div class="col-md-6 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h6>{{ $video->nombre }}</h6>
                                <div class="ratio ratio-16x9">
                                    <iframe src="{{ $video->enlace }}" allowfullscreen></iframe>
                                </div>
                                @if(auth()->user()->isAdmin() || auth()->user()->isProfesor())
                                    <form action="{{ route('videos.destroy', $video) }}" method="POST" class="mt-2" 
                                          onsubmit="return confirm('¿Eliminar este video?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> No hay videos disponibles.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="agregarVideoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('materias.videos.store', $materia) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Video</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre del Video *</label>
                        <input type="text" class="form-control" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Enlace del Video *</label>
                        <input type="url" class="form-control" name="enlace" placeholder="https://youtube.com/embed/..." required>
                        <small class="text-muted">URL de embed de YouTube, Vimeo, etc.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

