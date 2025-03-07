<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Cuenta - Hospital</title>
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
        <h2><i class="bi bi-heart-pulse me-2"></i>Crear Cuenta</h2>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="mb-3 icon-input">
                <i class="bi bi-person"></i>
                <input type="text" class="form-control" placeholder="Nombre Completo" id="name" name="name" required>
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
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
            <div class="mb-3 icon-input">
                <i class="bi bi-lock"></i>
                <input type="password" class="form-control" placeholder="Confirmar Contraseña" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-person-plus me-2"></i>Crear Cuenta
            </button>
        </form>
        <div class="text-center mt-3">
            <p class="text-muted">¿Ya tienes una cuenta? <a href="{{ route('login.index') }}">Iniciar Sesión</a></p>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Validación en tiempo real -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.getElementById('name');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const passwordConfirmationInput = document.getElementById('password_confirmation');

            const nameError = document.createElement('div');
            nameError.className = 'text-danger mt-1';
            nameInput.parentElement.appendChild(nameError);

            const emailError = document.createElement('div');
            emailError.className = 'text-danger mt-1';
            emailInput.parentElement.appendChild(emailError);

            const passwordError = document.createElement('div');
            passwordError.className = 'text-danger mt-1';
            passwordInput.parentElement.appendChild(passwordError);

            // Validación del nombre
            nameInput.addEventListener('input', function () {
                const name = nameInput.value;
                if (!/^[A-Za-z\s]+$/.test(name)) {
                    nameError.textContent = 'El nombre solo debe contener letras y espacios.';
                } else {
                    nameError.textContent = '';
                }
            });

            // Validación del correo
            emailInput.addEventListener('input', function () {
                const email = emailInput.value;
                if (!email.endsWith('.com')) {
                    emailError.textContent = 'El correo debe terminar con .com.';
                } else {
                    emailError.textContent = '';
                }
            });

            // Validación de la contraseña
            passwordInput.addEventListener('input', function () {
                const password = passwordInput.value;
                if (password.length < 8) {
                    passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres.';
                } else {
                    passwordError.textContent = '';
                }
            });

            // Validación antes de enviar el formulario
            document.querySelector('form').addEventListener('submit', function (e) {
                const name = nameInput.value;
                const email = emailInput.value;
                const password = passwordInput.value;
                const passwordConfirmation = passwordConfirmationInput.value;

                if (!/^[A-Za-z\s]+$/.test(name)) {
                    e.preventDefault();
                    nameError.textContent = 'El nombre solo debe contener letras y espacios.';
                }

                if (!email.endsWith('.com')) {
                    e.preventDefault();
                    emailError.textContent = 'El correo debe terminar con .com.';
                }

                if (password.length < 8) {
                    e.preventDefault();
                    passwordError.textContent = 'La contraseña debe tener al menos 8 caracteres.';
                }

                if (password !== passwordConfirmation) {
                    e.preventDefault();
                    passwordError.textContent = 'Las contraseñas no coinciden.';
                }
            });
        });
    </script>
</body>
</html>