@extends('layouts.app')

@section('title', 'Personalización')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">
            <a href="{{ route('dashboard') }}" class="text-decoration-none text-dark">
                <i class="fas fa-arrow-left"></i>
            </a>
            Personalización del Sistema
        </h1>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('personalizar.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="colegio" class="form-label">Nombre del Colegio *</label>
                            <input type="text" class="form-control @error('colegio') is-invalid @enderror" 
                                   id="colegio" name="colegio" 
                                   value="{{ old('colegio', $config->colegio ?? 'Aula Virtual') }}" required>
                            @error('colegio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Color Principal del Sistema</label>
                            <input type="color" class="form-control form-control-color @error('color') is-invalid @enderror" 
                                   id="color" name="color" 
                                   value="{{ old('color', $config->color ?? '#00704f') }}">
                            <small class="text-muted">Este color se aplicará en el header y menú del sistema</small>
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo del Colegio</label>
                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo" accept="image/*">
                            <small class="text-muted">Formato: JPG, PNG. Tamaño recomendado: 200x200px</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Vista Previa</h6>
                            </div>
                            <div class="card-body text-center">
                                @if($config && $config->logo)
                                    <img src="{{ asset('storage/' . $config->logo) }}" 
                                         alt="Logo" class="img-fluid mb-3" style="max-height: 150px;"
                                         onerror="this.src='{{ asset('img/logo.png') }}'">
                                @else
                                    <img src="{{ asset('img/logo.png') }}" 
                                         alt="Logo" class="img-fluid mb-3" style="max-height: 150px;">
                                @endif
                                <h5>{{ $config->colegio ?? 'Aula Virtual' }}</h5>
                                <div class="mt-3 p-3" style="background-color: {{ $config->color ?? '#00704f' }}; color: white;">
                                    <strong>Color Actual</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-header">
            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Información</h5>
        </div>
        <div class="card-body">
            <p><strong>Última actualización:</strong> {{ $config->updated_at->format('d/m/Y H:i') ?? 'Sin actualizar' }}</p>
            <p class="mb-0"><strong>Nota:</strong> Los cambios se aplicarán inmediatamente en todo el sistema.</p>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Vista previa del color en tiempo real
    document.getElementById('color').addEventListener('change', function() {
        document.querySelector('.card-body > .mt-3').style.backgroundColor = this.value;
    });

    // Vista previa del logo
    document.getElementById('logo').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.card-body.text-center img').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush
@endsection

