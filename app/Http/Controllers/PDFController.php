<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Student; // Importa el modelo de estudiante si es necesario


class PDFController extends Controller
{
    public function exportarAPDF(Request $request)
    {
        // Obtiene el contenido del POST
        $contenido = $request->input('contenido');

        // Crea una instancia de Dompdf
        $dompdf = new Dompdf();

        // Carga el contenido HTML en Dompdf
        $dompdf->loadHtml($contenido);

        // Renderiza el PDF
        $dompdf->render();

        // Devuelve el PDF como una respuesta HTTP
        return response($dompdf->output())
            ->header('Content-Type', 'application/pdf');
    }
}

