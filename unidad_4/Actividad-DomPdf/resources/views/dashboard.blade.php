<x-layouts::app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4">
        <div class="flex items-center justify-between px-1">
            <div>
                <h1 class="text-2xl font-bold text-neutral-900 dark:text-neutral-100">Pronóstico del Clima SLP</h1>
                <p class="text-sm text-neutral-500">Datos de la API de Open-Meteo</p>
            </div>
            <button type="button" id="downloadPdfBtn" class="inline-flex items-center gap-2 rounded-lg bg-neutral-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-neutral-700 disabled:opacity-50 dark:bg-white dark:text-neutral-900 dark:hover:bg-neutral-200" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9-9 0 0 0-9-9Z" />
                </svg>
                Descargar PDF
            </button>
        </div>

        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <div class="flex flex-col rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                <h2 class="mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Temperatura SLP (24 h)</h2>
                <div class="relative h-44">
                    <canvas id="tempChart"></canvas>
                    <div id="tempLoading" class="absolute inset-0 flex items-center justify-center">
                        <div class="size-8 animate-spin rounded-full border-2 border-neutral-300 border-t-blue-500 dark:border-neutral-600 dark:border-t-blue-500"></div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                <h2 class="mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Humedad SLP</h2>
                <div class="relative h-44">
                    <canvas id="humidityChart"></canvas>
                    <div id="humidityLoading" class="absolute inset-0 flex items-center justify-center">
                        <div class="size-8 animate-spin rounded-full border-2 border-neutral-300 border-t-blue-500 dark:border-neutral-600 dark:border-t-blue-500"></div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
                <h2 class="mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Precipitación SLP</h2>
                <div class="relative h-44">
                    <canvas id="precipChart"></canvas>
                    <div id="precipLoading" class="absolute inset-0 flex items-center justify-center">
                        <div class="size-8 animate-spin rounded-full border-2 border-neutral-300 border-t-blue-500 dark:border-neutral-600 dark:border-t-blue-500"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex min-h-0 flex-1 flex-col rounded-xl border border-neutral-200 bg-white p-4 dark:border-neutral-700 dark:bg-neutral-900">
            <h2 class="mb-2 text-sm font-semibold text-neutral-700 dark:text-neutral-300">Comparación de Temperatura — 7 días</h2>
            <div class="relative min-h-0 flex-1">
                <canvas id="comparisonChart"></canvas>
                <div id="comparisonLoading" class="absolute inset-0 flex items-center justify-center">
                    <div class="size-8 animate-spin rounded-full border-2 border-neutral-300 border-t-blue-500 dark:border-neutral-600 dark:border-t-blue-500"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const cities = [
                { name: 'San Luis Potosí', lat: 22.15, lon: -100.98 },
                { name: 'Guadalajara',       lat: 20.67, lon: -103.34 },
                { name: 'Monterrey',         lat: 25.69, lon: -100.32 },
            ];

            const weatherUrl = '{{ route('weather.forecast') }}';

            async function fetchWeather(city) {
                const url = `${weatherUrl}?latitude=${city.lat}&longitude=${city.lon}&hourly=temperature_2m,relative_humidity_2m,precipitation,wind_speed_10m`;
                const res = await fetch(url);
                return res.json();
            }

            function hourLabels(times, count) {
                return times.slice(0, count).map(t =>
                    new Date(t).toLocaleTimeString('es-MX', { hour: '2-digit' })
                );
            }

            function fullLabels(times) {
                return times.map(t =>
                    new Date(t).toLocaleString('es-MX', { day: '2-digit', month: 'short', hour: '2-digit' })
                );
            }

            const isDark = document.documentElement.classList.contains('dark');
            const textColor = isDark ? '#d4d4d8' : '#3f3f46';
            const gridColor = isDark ? 'rgba(255,255,255,0.08)' : 'rgba(0,0,0,0.08)';

            function axisOptions(maxTicksLimit) {
                return {
                    x: { ticks: { color: textColor, maxTicksLimit }, grid: { color: gridColor } },
                    y: { ticks: { color: textColor }, grid: { color: gridColor } },
                };
            }

            try {
                const cdmx = await fetchWeather(cities[0]);
                const h = 24;
                const labels24 = hourLabels(cdmx.hourly.time, h);
                const temps    = cdmx.hourly.temperature_2m.slice(0, h);
                const humidity = cdmx.hourly.relative_humidity_2m.slice(0, h);
                const precip   = cdmx.hourly.precipitation.slice(0, h);

                new Chart(document.getElementById('tempChart'), {
                    type: 'line',
                    data: {
                        labels: labels24,
                        datasets: [{
                            label: 'Temperatura (°C)',
                            data: temps,
                            borderColor: '#ef4444',
                            backgroundColor: 'rgba(239, 68, 68, 0.1)',
                            fill: true,
                            tension: 0.3,
                            pointRadius: 2,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            ...axisOptions(12),
                            y: { ticks: { color: textColor }, grid: { color: gridColor }, beginAtZero: false },
                        },
                    },
                });

                new Chart(document.getElementById('humidityChart'), {
                    type: 'line',
                    data: {
                        labels: labels24,
                        datasets: [{
                            label: 'Humedad (%)',
                            data: humidity,
                            borderColor: '#3b82f6',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            fill: true,
                            tension: 0.3,
                            pointRadius: 2,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            ...axisOptions(12),
                            y: { ticks: { color: textColor }, grid: { color: gridColor }, beginAtZero: true, max: 100 },
                        },
                    },
                });

                new Chart(document.getElementById('precipChart'), {
                    type: 'bar',
                    data: {
                        labels: labels24,
                        datasets: [{
                            label: 'Precipitación (mm)',
                            data: precip,
                            backgroundColor: 'rgba(34, 211, 238, 0.7)',
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            ...axisOptions(12),
                            y: { ticks: { color: textColor }, grid: { color: gridColor }, beginAtZero: true },
                        },
                    },
                });

                document.getElementById('tempLoading').style.display = 'none';
                document.getElementById('humidityLoading').style.display = 'none';
                document.getElementById('precipLoading').style.display = 'none';

                const allData = await Promise.all(cities.map(fetchWeather));
                const fullLab = fullLabels(allData[0].hourly.time);
                const colors = ['#ef4444', '#3b82f6', '#22c55e'];

                const datasets = cities.map((city, i) => ({
                    label: city.name,
                    data: allData[i].hourly.temperature_2m,
                    borderColor: colors[i],
                    backgroundColor: colors[i] + '20',
                    tension: 0.3,
                    fill: false,
                    pointRadius: 0,
                    borderWidth: 2,
                }));

                new Chart(document.getElementById('comparisonChart'), {
                    type: 'line',
                    data: { labels: fullLab, datasets },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        interaction: { mode: 'index', intersect: false },
                        plugins: {
                            legend: { position: 'top', labels: { color: textColor } },
                        },
                        scales: {
                            ...axisOptions(14),
                            y: { ticks: { color: textColor }, grid: { color: gridColor }, beginAtZero: false },
                        },
                    },
                });

                document.getElementById('comparisonLoading').style.display = 'none';

                // Habilitar botón de PDF y configurar captura de gráficas
                const pdfBtn = document.getElementById('downloadPdfBtn');
                pdfBtn.disabled = false;

                pdfBtn.addEventListener('click', async () => {
                    pdfBtn.disabled = true;
                    pdfBtn.lastChild.textContent = ' Generando...';

                    // Capturar cada canvas como imagen PNG base64
                    const chartIds = ['tempChart', 'humidityChart', 'precipChart', 'comparisonChart'];
                    const charts = {};
                    chartIds.forEach(id => {
                        const canvas = document.getElementById(id);
                        if (canvas && canvas.width > 0) {
                            charts[id] = canvas.toDataURL('image/png');
                        }
                    });

                    try {
                        const res = await fetch('{{ route("dashboard.pdf") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/pdf',
                            },
                            body: JSON.stringify({ charts }),
                        });

                        if (!res.ok) throw new Error('Error del servidor');

                        const blob = await res.blob();
                        const url = URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'reporte-clima-slp.pdf';
                        a.click();
                        URL.revokeObjectURL(url);
                    } catch (e) {
                        console.error('Error al generar el PDF:', e);
                        alert('No se pudo generar el PDF. Inténtalo de nuevo.');
                    } finally {
                        pdfBtn.disabled = false;
                        pdfBtn.lastChild.textContent = ' Descargar PDF';
                    }
                });
            } catch (err) {
                console.error('Error al cargar los datos del clima:', err);
                document.querySelectorAll('[id$="Loading"]').forEach(el => {
                    el.innerHTML = '<p class="text-sm text-red-500">Error al cargar</p>';
                });
            }
        });
    </script>
</x-layouts::app>
