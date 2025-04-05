<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor Médico Avanzado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --normal: #28a745;
            --warning: #ffc107;
            --critical: #dc3545;
            --unknown: #6c757d;
        }
        .vital-card {
            transition: all 0.3s;
            border-left: 5px solid;
        }
        .signal-excellent { border-left-color: var(--normal); }
        .signal-weak { border-left-color: var(--warning); }
        .signal-poor { border-left-color: var(--critical); }
        .pulse-alert {
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(220, 53, 69, 0); }
            100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
        }
        .value-display {
            font-size: 2.8rem;
            font-weight: 700;
            position: relative;
        }
        .trend-indicator {
            font-size: 1.2rem;
            margin-left: 0.5rem;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }
        .trend-up { color: #dc3545; }
        .trend-down { color: #28a745; }
        .trend-stable { color: #6c757d; }
        .progress-bar {
            transition: width 0.5s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container-fluid mt-4">
        @yield('content')
    </div>

    <script>
        const ctx = document.getElementById('sensorChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'Señal Infrarroja (IR)',
                        data: [],
                        borderColor: '#007bff',
                        borderWidth: 2,
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: 'Señal Roja (Red)',
                        data: [],
                        borderColor: '#dc3545',
                        borderWidth: 2,
                        tension: 0.1,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Tiempo (muestras)',
                            color: '#6c757d'
                        },
                        grid: {
                            display: false
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Intensidad de Señal',
                            color: '#6c757d'
                        },
                        suggestedMin: 0
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            padding: 20
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                }
            }
        });

        let readingStartTime = null;
        let updateInterval = null;

        async function updateDashboard() {
            try {
                const response = await fetch('http://192.168.242.135:5000/get_data');
                if (!response.ok) throw new Error(`Error HTTP: ${response.status}`);
                
                const result = await response.json();
                console.log('Datos recibidos:', result);
                
                if (result.status !== 'success' || !result.data || !Array.isArray(result.data)) {
                    throw new Error(result.message || 'Datos inválidos');
                }

                updateSignalIndicator(result.signal_quality || 'unknown');
                
                if (result.data.length > 0) {
                    if (!readingStartTime) readingStartTime = new Date();
                    
                    updateChart(result.data);
                    updateVitals(result.data[result.data.length - 1]);
                    
                    const readingTime = Math.floor((new Date() - readingStartTime) / 1000);
                    document.getElementById('reading-time').textContent = 
                        `Tiempo de lectura: ${readingTime}s (óptimo: 30-45s)`;
                }

                if (result.diagnosis) updateDiagnosis(result.diagnosis);
                if (result.trends) updateTrends(result.trends);
                
                document.getElementById('last-update').textContent = 
                    `Última actualización: ${new Date().toLocaleTimeString()}`;
                
            } catch (error) {
                console.error("Error al actualizar:", error);
                showError(error.message);
            }
        }

        function updateChart(sensorData) {
            const maxDataPoints = 50;
            const limitedData = sensorData.slice(-maxDataPoints);
            
            chart.data.labels = limitedData.map((_, i) => i);
            chart.data.datasets[0].data = limitedData.map(d => d.ir || 0);
            chart.data.datasets[1].data = limitedData.map(d => d.red || 0);
            chart.update();
        }

        function updateVitals(latestReading) {
            // Actualizar SpO2
            if (latestReading.spo2) {
                document.getElementById('spo2-value').textContent = `${latestReading.spo2.toFixed(1)}%`;
                document.getElementById('spo2-progress').style.width = `${latestReading.spo2}%`;
            }

            // Actualizar BPM
            if (latestReading.bpm) {
                document.getElementById('bpm-value').textContent = Math.round(latestReading.bpm);
                document.getElementById('bpm-progress').style.width = 
                    `${Math.min(100, latestReading.bpm)}%`;
            }

            // Actualizar Temperatura
            if (latestReading.temp) {
                const tempValue = latestReading.temp;
                document.getElementById('temp-value').textContent = `${tempValue.toFixed(1)}°C`;
                const tempProgress = document.getElementById('temp-progress');
                const tempPercentage = ((tempValue - 35) / (40 - 35)) * 100;
                tempProgress.style.width = `${tempPercentage}%`;
                tempProgress.className = `progress-bar ${
                    tempValue >= 37.6 ? 'bg-danger' : 
                    tempValue <= 35.9 ? 'bg-warning' : 'bg-success'
                }`;
            }
        }

        function updateTrends(trends) {
            const trendIcons = {
                rising: '<i class="fas fa-arrow-up trend-up"></i>',
                falling: '<i class="fas fa-arrow-down trend-down"></i>',
                stable: '<i class="fas fa-minus trend-stable"></i>'
            };

            ['spo2', 'bpm', 'temp'].forEach(metric => {
                const element = document.getElementById(`${metric}-trend`);
                if (element) {
                    element.innerHTML = trendIcons[trends[metric]] || '';
                }
            });
        }

        function updateSignalIndicator(quality) {
            const indicator = document.getElementById('signal-indicator');
            const statusMap = {
                excellent: {
                    icon: 'fa-check-circle',
                    text: 'Señal óptima',
                    class: 'bg-success text-white'
                },
                weak: {
                    icon: 'fa-exclamation-triangle',
                    text: 'Señal débil',
                    class: 'bg-warning text-dark'
                },
                poor: {
                    icon: 'fa-times-circle',
                    text: 'Sin señal',
                    class: 'bg-danger text-white'
                },
                default: {
                    icon: 'fa-circle-notch fa-spin',
                    text: 'Conectando...',
                    class: 'bg-light text-dark'
                }
            };

            const status = statusMap[quality] || statusMap.default;
            indicator.innerHTML = `<i class="fas ${status.icon} me-1"></i> ${status.text}`;
            indicator.className = `badge ${status.class}`;

            // Actualizar tarjetas
            ['spo2-card', 'bpm-card', 'temp-card'].forEach(id => {
                document.getElementById(id).className = 
                    `card shadow mb-3 vital-card signal-${quality}`;
            });
        }

        function updateDiagnosis(diagnosis) {
            console.log('Diagnóstico recibido:', diagnosis);
            const diagnosisContent = document.getElementById('diagnosis-content');
            const diagnosisCard = document.getElementById('diagnosis-card');
            
            diagnosisContent.innerHTML = '';
            
            // Alert principal
            const mainAlert = document.createElement('div');
            mainAlert.className = `alert alert-${diagnosis.severity} mb-3`;
            mainAlert.innerHTML = `
                <i class="fas ${getSeverityIcon(diagnosis.severity)} me-2"></i>
                <strong>Estado:</strong> ${diagnosis.messages.join(' • ')}
            `;

            // Tarjetas de métricas
            const metricsRow = document.createElement('div');
            metricsRow.className = 'row mb-3';
            
            const createMetricCard = (metric, title) => `
                <div class="col-md-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h6><i class="${diagnosis[metric].icon} me-2"></i> ${title}</h6>
                            <div class="value-display text-center my-2 ${getSeverityClass(diagnosis[metric].severity)}">
                                ${metric === 'temp' ? diagnosis[metric].value.toFixed(1) : diagnosis[metric].value}
                                ${metric === 'spo2' ? '%' : metric === 'temp' ? '°C' : 'bpm'}
                            </div>
                            <div class="text-center">
                                <small class="text-muted">${diagnosis[metric].normal_range}</small>
                            </div>
                            <p class="mt-2 mb-0 small">${diagnosis[metric].description}</p>
                        </div>
                    </div>
                </div>`;

            metricsRow.innerHTML = `
                ${createMetricCard('spo2', 'SpO₂')}
                ${createMetricCard('bpm', 'Frecuencia Cardíaca')}
                ${createMetricCard('temp', 'Temperatura')}
            `;

            // Recomendación
            const recommendation = document.createElement('div');
            recommendation.className = 'alert alert-info';
            recommendation.innerHTML = `
                <i class="fas fa-lightbulb me-2"></i>
                <strong>Recomendación:</strong> ${getRecommendation(diagnosis)}
            `;

            // Ensamblar componentes
            diagnosisContent.appendChild(mainAlert);
            diagnosisContent.appendChild(metricsRow);
            diagnosisContent.appendChild(recommendation);

            // Animación de alerta crítica
            diagnosisCard.className = `card shadow ${diagnosis.severity === 'critical' ? 'pulse-alert' : ''}`;
        }

        function getSeverityIcon(severity) {
            return {
                critical: 'fa-exclamation-triangle',
                warning: 'fa-exclamation-circle',
                normal: 'fa-check-circle'
            }[severity] || 'fa-question-circle';
        }

        function getSeverityClass(severity) {
            return {
                normal: 'text-success',
                warning: 'text-warning',
                critical: 'text-danger'
            }[severity] || 'text-secondary';
        }

        function getRecommendation(diagnosis) {
            const specificRecommendations = {
                // SpO2
                'Oxigenación sanguínea peligrosamente baja': 'Administre oxígeno suplementario y busque atención de emergencia inmediatamente.',
                'Oxigenación sanguínea baja': 'Mejore la ventilación del área y consulte a un médico dentro de las próximas 2 horas.',
                'SpO2 normal': 'Niveles de oxígeno dentro del rango normal. Continúe con el monitoreo regular.',
                
                // BPM
                'Arritmia': '¡Emergencia! Solicite atención médica inmediata.',
                'Bradicardia': 'Verifique medicamentos recientes y monitorice signos vitales.',
                'Taquicardia': 'Mantenga reposo y busque causas subyacentes (deshidratación, infección).',
                'Ritmo cardíaco normal': 'Frecuencia cardíaca dentro de parámetros normales.',
                
                // Temperatura
                'Hipotermia': 'Aplique calor gradual y evite fricción brusca. Monitorice cada 15 minutos.',
                'Fiebre': 'Administre antipiréticos y mantenga hidratación oral.',
                'Hiperpirexia': '¡Emergencia! Enfríe el cuerpo con paños húmedos y busque atención inmediata.',
                'Temperatura normal': 'Temperatura corporal dentro del rango saludable.'
            };

            let recommendations = diagnosis.messages
                .map(msg => specificRecommendations[msg])
                .filter(r => r);

            if (recommendations.length === 0) {
                recommendations.push({
                    critical: "¡Emergencia médica! Busque atención especializada inmediatamente.",
                    warning: "Requiere evaluación médica dentro de las próximas 2 horas.",
                    normal: "Todos los parámetros están dentro de rangos normales."
                }[diagnosis.severity]);
            }

            if (diagnosis.severity === 'critical') {
                recommendations.unshift("¡EMERGENCIA MÉDICA! ACCIÓN INMEDIATA REQUERIDA:");
            }

            return recommendations
                .map(r => `• ${r}`)
                .join('<br>');
        }

        function showError(message) {
            const diagnosisContent = document.getElementById('diagnosis-content');
            diagnosisContent.innerHTML = `
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Error:</strong> ${message}
                </div>
            `;
        }

        // Inicialización
        document.addEventListener('DOMContentLoaded', () => {
            updateInterval = setInterval(updateDashboard, 1000);
            updateDashboard();
        });

        window.addEventListener('beforeunload', () => {
            if (updateInterval) clearInterval(updateInterval);
        });
    </script>
</body>
</html>
