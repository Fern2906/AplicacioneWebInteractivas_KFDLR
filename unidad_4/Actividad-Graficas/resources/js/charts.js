import Chart from 'chart.js/auto';

// Hacer Chart.js disponible globalmente para usarlo desde las vistas Blade
window.Chart = Chart;

// Inicializa automáticamente todos los canvas con el atributo data-chart
// Ejemplo de uso en Blade:
// <canvas data-chart='{"type":"bar","data":{"labels":["A","B"],"datasets":[{"data":[1,2]}]}}'></canvas>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('canvas[data-chart]').forEach((canvas) => {
        const config = JSON.parse(canvas.dataset.chart);
        new Chart(canvas, config);
    });
});
