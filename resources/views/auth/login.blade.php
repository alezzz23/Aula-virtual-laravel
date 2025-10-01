@php
    $config = \App\Models\Personalizar::latest()->first() ?? new \App\Models\Personalizar(['colegio' => 'Aula Virtual', 'logo' => 'img/logo.png', 'color' => '#00704f']);
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $config->colegio ?? 'Aula Virtual' }} - Login</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: {{ $config->color }};
        }
        
        body {
            background: linear-gradient(135deg, var(--primary-color) 0%, #1a5c45 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            overflow: hidden;
            max-width: 400px;
            width: 100%;
        }
        
        .login-header {
            background: var(--primary-color);
            color: white;
            padding: 30px;
            text-align: center;
        }
        
        .login-header img {
            width: 120px;
            height: 120px;
            object-fit: contain;
            margin-bottom: 15px;
        }
        
        .login-body {
            padding: 30px;
        }
        
        .btn-login {
            background: var(--primary-color);
            border: none;
            padding: 12px;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: #1a5c45;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(0, 112, 79, 0.25);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <img src="{{ asset('storage/' . $config->logo) }}" alt="Logo" onerror="this.src='{{ asset('img/logo.png') }}'">
            <h3 class="mb-0">{{ $config->colegio }}</h3>
            <p class="mb-0">Aula Virtual</p>
        </div>
        
        <div class="login-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p class="mb-0">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-3">
                    <label for="usuario" class="form-label">Usuario</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" 
                               class="form-control @error('usuario') is-invalid @enderror" 
                               id="usuario" 
                               name="usuario" 
                               value="{{ old('usuario') }}" 
                               required 
                               autofocus>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               required>
                    </div>
                </div>
                
                <button type="submit" class="btn btn-primary btn-login w-100">
                    <i class="fas fa-sign-in-alt me-2"></i> CONECTAR
                </button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

