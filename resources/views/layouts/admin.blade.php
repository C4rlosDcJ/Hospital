<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel de Administración')</title>
    
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    

    <style>
        :root {
            --primary-color: #1a237e;
            --secondary-color: #0d47a1;
            --accent-color: #4CAF50;
            --text-dark: #2c3e50;
            --text-light: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #f8f9fa;
            min-height: 100vh;
        }

        /* Sidebar Modernizado */
        .sidebar {
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
            position: fixed;
            top: 0;
            left: 0;
            padding: 1.5rem;
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .sidebar .logo {
            color: var(--text-light);
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            padding: 1rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .sidebar .logo:hover {
            transform: scale(1.05);
        }

        .sidebar .logo i {
            color: #4CAF50;
            margin-right: 0.5rem;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.8rem 1.5rem;
            margin: 0.4rem 0;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .sidebar .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            width: 3px;
            height: 100%;
            background: var(--accent-color);
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-light);
            padding-left: 1.8rem;
        }

        .sidebar .nav-link:hover::before {
            transform: scaleY(1);
        }

        .sidebar .nav-link.active {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-light);
        }

        .sidebar .nav-link i {
            width: 25px;
            margin-right: 1rem;
            font-size: 1.1rem;
        }

        /* Contenido Principal */
        .main-content {
            margin-left: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* Navbar Superior */
        .top-navbar {
            background: #ffffff;
            padding: 0.8rem 2rem;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
            border-bottom: 1px solid #e9ecef;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .top-navbar .navbar-brand {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--primary-color);
            display: flex;
            align-items: center;
        }

        .top-navbar .navbar-brand i {
            margin-right: 0.8rem;
            color: var(--accent-color);
        }

        .user-menu .dropdown-toggle {
            display: flex;
            align-items: center;
            color: var(--text-dark);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .user-menu .dropdown-toggle:hover {
            background: rgba(var(--primary-color), 0.05);
        }

        .user-menu .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-right: 0.8rem;
        }

        /* Tarjetas Modernas */
        .dashboard-card {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: var(--text-light);
            border-radius: 12px 12px 0 0;
            padding: 1.2rem 1.5rem;
        }

        /* Botones */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 8px;
            padding: 0.8rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(var(--primary-color), 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
                transition: all 0.3s ease;
            }

            .sidebar.active {
                width: 280px;
            }

            .main-content {
                margin-left: 0;
            }

            .top-navbar {
                padding: 0.8rem 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Barra Lateral -->
    <div class="sidebar">
        <div class="logo">
            <i class="fas fa-hospital"></i> MedCenter
            CERM
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.dashboard')}}">
                    <i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users-cog"></i> Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('citas.index')}}">
                    <i class="fas fa-calendar-check"></i> Citas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('oximetro.index')}}">
                    <i class="fas fa-heartbeat"></i> Oxímetro
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('operaciones.index')}}">
                    <i class="fas fa-procedures"></i> Operaciones
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pacientes.index')}}">
                    <i class="fas fa-user-injured"></i> Pacientes
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('control')}}">
                    <i class="fas fa-user-injured"></i> Inyectar paciente
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('users.index') }}">
                    <i class="fas fa-users-cog"></i> Users
                </a>
            </li>
        </ul>
    </div>

    <!-- Contenido Principal -->
    <div class="main-content">
        <!-- Barra Superior -->
        <nav class="top-navbar navbar navbar-expand">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-clinic-medical"></i> Panel de Administración
                </a>
                
                <div class="user-menu ms-auto">
                    <div class="dropdown">
                        <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">   
                            <span>Administrador</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog me-2"></i>Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Contenido Dinámico -->
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Scripts Adicionales -->
    <script>
        // Toggle Sidebar en móviles
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('active');
        }
    </script>
</body>
</html>