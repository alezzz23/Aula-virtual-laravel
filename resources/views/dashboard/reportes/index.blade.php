@extends('layouts.app')

@section('title', 'Comentarios')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('materias.show', $materia) }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Comentarios - {{ $materia->materia }}
        </h1>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-comments"></i> Comentarios de la Materia</h5>
        </div>
        <div class="card-body">
            <!-- Formulario para nuevo comentario -->
            <form action="{{ route('reportes.store') }}" method="POST" class="mb-4">
                @csrf
                <input type="hidden" name="idMa" value="{{ $materia->id }}">
                <div class="mb-3">
                    <label class="form-label">Escribe un comentario</label>
                    <textarea class="form-control @error('comentario') is-invalid @enderror" 
                              name="comentario" rows="3" required></textarea>
                    @error('comentario')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-paper-plane"></i> Enviar Comentario
                </button>
            </form>

            <hr>

            <!-- Lista de comentarios -->
            <div class="mt-4">
                @forelse($reportes as $reporte)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="d-flex">
                                    <div class="me-3">
                                        <img src="{{ asset('img/user.png') }}" alt="Avatar" 
                                             class="rounded-circle" width="50" height="50">
                                    </div>
                                    <div>
                                        <h6 class="mb-1">
                                            {{ $reporte->usuarioReporte->namefull ?? 'Usuario' }}
                                            <small class="text-muted">
                                                ({{ $reporte->usuarioReporte->role->descripcion ?? '' }})
                                            </small>
                                        </h6>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-clock"></i> 
                                            {{ $reporte->created_at->diffForHumans() }}
                                        </p>
                                        <p class="mb-0">{{ $reporte->comentario }}</p>
                                    </div>
                                </div>
                                @if(auth()->id() == $reporte->usuario || auth()->user()->isAdmin())
                                    <form action="{{ route('reportes.destroy', $reporte) }}" method="POST" 
                                          onsubmit="return confirm('¿Eliminar este comentario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> No hay comentarios aún. ¡Sé el primero en comentar!
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection

