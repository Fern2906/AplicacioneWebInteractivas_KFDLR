<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfController extends Controller
{
    /**
     * Genera un PDF con las imágenes de las gráficas enviadas desde el navegador.
     */
    public function weatherReport(Request $request)
    {
        $charts = $request->input('charts', []);

        $html = view('pdf.report', [
            'charts' => $charts,
            'date'   => now()->format('d/m/Y H:i'),
        ])->render();

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        return response($dompdf->output(), 200, [
            'Content-Type'        => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="reporte-clima-slp.pdf"',
        ]);
    }
}
