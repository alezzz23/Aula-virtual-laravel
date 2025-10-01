@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="fas fa-newspaper"></i> Eventos y Publicaciones</h5>
    </div>
    <div class="card-body">
        @forelse($eventos as $evento)
            <div class="mb-4">
                <h5>{{ $evento->titulo }}</h5>
                <p class="text-justify">{{ $evento->descripcion }}</p>
                
                @if($evento->esImagen())
                    <img src="{{ asset('storage/eventos/' . $evento->archivo) }}" 
                         alt="{{ $evento->titulo }}" 
                         class="img-fluid rounded mb-2">
                @elseif($evento->esVideo())
                    <video src="{{ asset('storage/eventos/' . $evento->archivo) }}" 
                           controls 
                           class="img-fluid rounded mb-2"></video>
                @endif
                
                <p class="text-muted small">
                    <i class="fas fa-calendar"></i> {{ $evento->fecha->format('d/m/Y H:i') }}
                </p>
                <hr>
            </div>
        @empty
            <p class="text-muted">No hay eventos publicados.</p>
        @endforelse
    </div>
</div>
@endsection

