<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Servos Robóticos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex flex-col items-center justify-center p-4">
        <div class="w-full max-w-4xl bg-white rounded-xl shadow-2xl p-6 space-y-8">
            <!-- Encabezado -->
            <div class="text-center space-y-2">
                <h1 class="text-3xl font-bold text-gray-800">Control Robótico Web</h1>
                <p class="text-gray-600">Control de servomotores en tiempo real</p>
            </div>

            <!-- Contenedor de Servos -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @for($i = 0; $i < 4; $i++)
                    <div class="servo-card group">
                        <button 
                            class="servo-btn w-full flex items-center justify-between px-6 py-4 transition-all"
                            data-servo="{{ $i }}"
                            id="servo-{{ $i }}"
                        >
                            <div class="flex items-center space-x-3">
                                <div class="servo-indicator w-3 h-3 rounded-full bg-gray-400"></div>
                                <span class="font-semibold text-gray-700">Servo {{ $i + 1 }}</span>
                            </div>
                            <span class="status-text text-sm font-medium text-gray-600">Inactivo</span>
                        </button>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <style>
        .servo-card {
            @apply bg-white rounded-lg border border-gray-200 hover:border-green-500 transition-colors;
        }
        
        .servo-btn.active {
            @apply bg-green-50 border-green-500;
        }
        
        .servo-btn.active .servo-indicator {
            @apply bg-green-500;
        }
        
        .servo-btn.active .status-text {
            @apply text-green-600;
        }
        
        .servo-btn:hover:not(.active) {
            @apply bg-gray-50;
        }
    </style>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.servo-btn').click(function() {
                const servo = $(this).data('servo');
                const button = $(this);
                
                $.ajax({
                    url: 'https://18.212.80.15/command',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({ servo: servo }),
                    success: function(response) {
                        button.toggleClass('active');
                        const estado = button.hasClass('active') ? 'Activo' : 'Inactivo';
                        button.find('.status-text').text(estado);
                        console.log(`Estado actualizado: Servo ${servo} - ${estado}`);
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert('Error al enviar comando!');
                    }
                });
            });
        });
    </script>
</body>
</html>