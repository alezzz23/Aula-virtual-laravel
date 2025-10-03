@extends('layouts.app')

@section('title', 'Cursos')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Gestión de Cursos</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#crearCursoModal">
            <i class="fas fa-plus"></i> Nuevo Curso
        </button>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Cursos Activos ({{ $cursos->count() }})</h5>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="buscar" placeholder="Buscar...">
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sección</th>
                            <th>Materias</th>
                            <th>Estudiantes</th>
                            <th>Profesor Guía</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaCursos">
                        @forelse($cursos as $curso)
                            <tr>
                                <td><strong>{{ $curso->seccion }}</strong></td>
                                <td>{{ $curso->materias->count() }}</td>
                                <td>{{ $curso->alumnos()->count() }}</td>
                                <td>
                                    @if($curso->profesoresGuia->count() > 0)
                                        @foreach($curso->profesoresGuia as $profGuia)
                                            <span class="badge bg-success">{{ $profGuia->profesor->namefull ?? $profGuia->profesor->usuario }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">Sin asignar</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('cursos.alumnos', $curso) }}" class="btn btn-sm btn-info" title="Ver estudiantes">
                                        <i class="fas fa-users"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editarCursoModal{{ $curso->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#asignarProfesorModal{{ $curso->id }}">
                                        <i class="fas fa-user-tie"></i>
                                    </button>
                                    <form action="{{ route('cursos.destroy', $curso) }}" method="POST" class="d-inline" 
                                          onsubmit="return confirm('¿Deshabilitar este curso y sus materias?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            <!-- Modal Editar -->
                            <div class="modal fade" id="editarCursoModal{{ $curso->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('cursos.update', $curso) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title">Editar Curso</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Sección *</label>
                                                    <input type="text" class="form-control" name="seccion" value="{{ $curso->seccion }}" required>
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

                            <!-- Modal Asignar Profesor -->
                            <div class="modal fade" id="asignarProfesorModal{{ $curso->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('cursos.asignar-profesor-guia', $curso) }}" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h5 class="modal-title">Asignar Profesor Guía</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label">Profesor *</label>
                                                    <select class="form-select" name="profesor_id" required>
                                                        <option value="">Seleccione un profesor...</option>
                                                        @foreach($profesores as $profesor)
                                                            <option value="{{ $profesor->id }}">{{ $profesor->namefull }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                @if($curso->profesoresGuia->count() > 0)
                                                    <div class="alert alert-info">
                                                        <strong>Profesores guía actuales:</strong>
                                                        <ul class="mb-0 mt-2">
                                                            @foreach($curso->profesoresGuia as $profGuia)
                                                                <li>
                                                                    {{ $profGuia->profesor->namefull ?? $profGuia->profesor->usuario }}
                                                                    <form action="{{ route('cursos.eliminar-profesor-guia', $profGuia) }}" method="POST" class="d-inline">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-sm btn-danger btn-sm">
                                                                            <i class="fas fa-times"></i>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Asignar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No hay cursos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Curso -->
<div class="modal fade" id="crearCursoModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('cursos.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Nuevo Curso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Sección *</label>
                        <input type="text" class="form-control" name="seccion" placeholder="Ej: 1er Año A" required>
                        <small class="text-muted">Ejemplo: 1er Año A, 2do Año B, etc.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear Curso</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('buscar').addEventListener('keyup', function() {
        var value = this.value.toLowerCase();
        var rows = document.querySelectorAll('#tablaCursos tr');
        
        rows.forEach(function(row) {
            var text = row.textContent.toLowerCase();
            row.style.display = text.includes(value) ? '' : 'none';
        });
    });
</script>
@endpush
@endsection

