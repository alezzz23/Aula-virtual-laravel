@extends('layouts.app')

@section('title', 'Calendario')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Calendario de Eventos
        </h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearFechaModal">
            <i class="fas fa-plus"></i> Nuevo Evento
        </button>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Eventos Programados</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($fechas as $fecha)
                            <tr>
                                <td>
                                    <span class="badge bg-primary">
                                        {{ \Carbon\Carbon::parse($fecha->fecha)->format('d/m/Y') }}
                                    </span>
                                </td>
                                <td><strong>{{ $fecha->titulo }}</strong></td>
                                <td>{{ $fecha->descripcion }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-warning" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editarFechaModal{{ $fecha->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('fechas.destroy', $fecha) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('¿Eliminar este evento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Editar -->
                            <div class="modal fade" id="editarFechaModal{{ $fecha->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('fechas.update', $fecha) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Evento</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Título *</label>
                                                    <input type="text" class="form-control" name="titulo" value="{{ $fecha->titulo }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Descripción</label>
                                                    <textarea class="form-control" name="descripcion" rows="3">{{ $fecha->descripcion }}</textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Fecha *</label>
                                                    <input type="date" class="form-control" name="fecha" value="{{ \Carbon\Carbon::parse($fecha->fecha)->format('Y-m-d') }}" required>
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
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No hay eventos programados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Fecha -->
<div class="modal fade" id="crearFechaModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('fechas.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Evento en Calendario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Título *</label>
                        <input type="text" class="form-control" name="titulo" 
                               placeholder="Ej: Inicio de clases" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" name="descripcion" rows="3" 
                                  placeholder="Detalles del evento"></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fecha *</label>
                        <input type="date" class="form-control" name="fecha" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Evento</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

