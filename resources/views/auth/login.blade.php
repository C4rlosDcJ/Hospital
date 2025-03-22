<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Hospital</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <style>
        body {
            background: #f8f9fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Arial', sans-serif;
        }
        .auth-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            margin: 1rem;
        }
        .auth-card h2 {
            color: #2c3e50;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .auth-card .form-control {
            border-radius: 8px;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }
        .auth-card .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }
        .auth-card .btn-primary {
            background: #3498db;
            border: none;
            border-radius: 8px;
            padding: 0.75rem;
            font-size: 1rem;
            font-weight: 600;
            transition: background 0.3s ease;
        }
        .auth-card .btn-primary:hover {
            background: #2980b9;
        }
        .auth-card .icon-input {
            position: relative;
        }
        .auth-card .icon-input i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #95a5a6;
        }
        .auth-card .icon-input input {
            padding-left: 2.5rem;
        }
        .auth-card .text-muted {
            color: #7f8c8d !important;
        }
        .auth-card .text-muted a {
            color: #3498db;
            text-decoration: none;
            font-weight: 600;
        }
        .auth-card .text-muted a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <h2><i class="bi bi-heart-pulse me-2"></i>Iniciar Sesión</h2>
        <!-- Mostrar mensaje de error si hay demasiados intentos fallidos -->
        @if ($errors->has('email'))
        <div class="alert alert-danger">
            {{ $errors->first('email') }}
        </div>
        @endif
        <form action="{{ route('login.store') }}" method="POST">
            @csrf
            <div class="mb-3 icon-input">
                <i class="bi bi-envelope"></i>
                <input type="email" class="form-control" placeholder="Email" id="email" name="email" required>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3 icon-input">
                <i class="bi bi-lock"></i>
                <input type="password" class="form-control" placeholder="Contraseña" id="password" name="password" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
            </button>
        </form>
        <div class="text-center mt-3">
            <p class="text-muted">¿No tienes una cuenta? <a href="{{ route('register') }}">Crear Cuenta</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Validación en tiempo real -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const emailInput = document.getElementById('email');
            const emailError = document.createElement('div');
            emailError.className = 'text-danger mt-1';
            emailInput.parentElement.appendChild(emailError);

            emailInput.addEventListener('input', function () {
                const email = emailInput.value;
                if (!email.endsWith('.com')) {
                    emailError.textContent = 'El correo debe terminar con .com.';
                } else {
                    emailError.textContent = '';
                }
            });

            document.querySelector('form').addEventListener('submit', function (e) {
                const email = emailInput.value;
                if (!email.endsWith('.com')) {
                    e.preventDefault();
                    emailError.textContent = 'El correo debe terminar con .com.';
                }
            });
        });
    </script>
</body>
</html>