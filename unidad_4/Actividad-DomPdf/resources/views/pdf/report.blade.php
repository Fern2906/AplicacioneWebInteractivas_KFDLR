<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        * { font-family: Helvetica, Arial, sans-serif; }
        body { margin: 0; padding: 30px; color: #333; font-size: 12px; }
        h1 { color: #1a1a2e; font-size: 22px; margin: 0 0 4px; }
        h2 { color: #16213e; font-size: 15px; margin: 25px 0 8px; border-bottom: 2px solid #0f3460; padding-bottom: 4px; }
        .subtitle { color: #666; font-size: 11px; margin: 0 0 20px; }
        .header-bar { height: 5px; background: #0f3460; margin: 0 -30px 20px; }
        .chart-section { margin: 15px 0; }
        .chart-section h2 { margin-bottom: 6px; }
        .chart-section img { width: 100%; border: 1px solid #e0e0e0; border-radius: 6px; }
        .no-data { color: #999; font-style: italic; padding: 20px; text-align: center; }
    </style>
</head>
<body>
    <div class="header-bar"></div>

    <h1>Pronóstico del Clima — San Luis Potosí</h1>
    <p class="subtitle">Generado el {{ $date }}</p>

    <div class="chart-section">
        <h2>Gráfica de Temperatura — San Luis Potosí</h2>
        @if (!empty($charts['tempChart']))
            <img src="{{ $charts['tempChart'] }}" />
        @else
            <p class="no-data">Gráfica no disponible</p>
        @endif
    </div>

    <div class="chart-section">
        <h2>Gráfica de Humedad — San Luis Potosí</h2>
        @if (!empty($charts['humidityChart']))
            <img src="{{ $charts['humidityChart'] }}" />
        @else
            <p class="no-data">Gráfica no disponible</p>
        @endif
    </div>

    <div class="chart-section">
        <h2>Gráfica de Precipitación — San Luis Potosí</h2>
        @if (!empty($charts['precipChart']))
            <img src="{{ $charts['precipChart'] }}" />
        @else
            <p class="no-data">Gráfica no disponible</p>
        @endif
    </div>

    <div class="chart-section">
        <h2>Comparación de Temperatura — 7 días</h2>
        @if (!empty($charts['comparisonChart']))
            <img src="{{ $charts['comparisonChart'] }}" />
        @else
            <p class="no-data">Gráfica no disponible</p>
        @endif
    </div>
</body>
</html>
