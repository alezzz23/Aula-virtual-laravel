@extends('layouts.app')

@section('title', 'Eventos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Eventos</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearEventoModal">
            <i class="fas fa-plus"></i> Nuevo Evento
        </button>
    </div>

    <div class="row">
        @forelse($eventos as $evento)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($evento->imagen)
                        <img src="{{ asset('storage/' . $evento->imagen) }}" class="card-img-top" alt="{{ $evento->titulo }}" style="height: 200px; object-fit: cover;">
                    @elseif($evento->video)
                        <div class="ratio ratio-16x9">
                            <iframe src="{{ $evento->video }}" allowfullscreen></iframe>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $evento->titulo }}</h5>
                        <p class="card-text">{{ $evento->descripcion }}</p>
                        <p class="text-muted small">
                            <i class="fas fa-calendar"></i> {{ \Carbon\Carbon::parse($evento->fecha)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div class="card-footer bg-white">
                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editarEventoModal{{ $evento->id }}">
                            <i class="fas fa-edit"></i> Editar
                        </button>
                        <form action="{{ route('eventos.destroy', $evento) }}" method="POST" class="d-inline" 
                              onsubmit="return confirm('¿Eliminar este evento?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Modal Editar -->
                <div class="modal fade" id="editarEventoModal{{ $evento->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('eventos.update', $evento) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Evento</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label class="form-label">Título *</label>
                                        <input type="text" class="form-control" name="titulo" value="{{ $evento->titulo }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Descripción</label>
                                        <textarea class="form-control" name="descripcion" rows="3">{{ $evento->descripcion }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fecha</label>
                                        <input type="date" class="form-control" name="fecha" value="{{ \Carbon\Carbon::parse($evento->fecha)->format('Y-m-d') }}">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nueva Imagen</label>
                                        <input type="file" class="form-control" name="imagen">
                                        @if($evento->imagen)
                                            <small class="text-muted">Imagen actual: {{ basename($evento->imagen) }}</small>
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Enlace de Video</label>
                                        <input type="url" class="form-control" name="video" value="{{ $evento->video }}" placeholder="https://youtube.com/...">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> No hay eventos publicados.
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Modal Crear Evento -->
<div class="modal fade" id="crearEventoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('eventos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Título *</label>
                        <input type="text" class="form-control" name="titulo" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha del Evento</label>
                        <input type="date" class="form-control" name="fecha">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Imagen</label>
                        <input type="file" class="form-control" name="imagen">
                        <small class="text-muted">Opcional: JPG, PNG, etc.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Enlace de Video (YouTube, Vimeo, etc.)</label>
                        <input type="url" class="form-control" name="video" placeholder="https://youtube.com/...">
                        <small class="text-muted">Opcional: URL de video</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Publicar Evento</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

