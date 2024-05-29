<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dompdf\Dompdf;
use App\Models\Student; // Importa el modelo de estudiante
use App\Models\Parameter; // Importa el modelo de parámetros


class PDFController extends Controller
{
    public function exportarPDF(Request $request)
    {
        $dni = $request->get("id");
        // Obtén el estudiante por DNI
        $student = Student::where('dni', $dni)->first();
        $notes = $student->notes;
        /* dd($notes); */
        if (!$student) {
            return response('Estudiante no encontrado', 404);
        }

        // Obtén los parámetros
        $parametros = Parameter::first();
        $clases_totales = $parametros->total;
        $promocion = $parametros->promocion;
        $regular = $parametros->regular;

        // Calcula el promedio
        $promedioCrudo = ($student->assists->count()) / $clases_totales * 100;
        $promedio = round($promedioCrudo, 2); // Trunca a dos dígitos después de la coma

        // Determina el color basado en el promedio
        $color = '';
        if ($promedio < $regular) {
            $color = 'red';
        } elseif ($promedio >= $regular && $promedio < $promocion) {
            $color = 'blue';
        } elseif ($promedio >= $promocion) {
            $color = 'green';
        }

        // Genera el contenido HTML para el PDF
        $html = '<h1 style="text-align:center;"> Resumen de: ' . $student->name . ' ' . $student->surname . '</h1>';
        $html .= '<table border="1" style="width:100%; border-collapse: collapse; text-align:center;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>DNI</th>';
        $html .= '<th>Nombre</th>';
        $html .= '<th>Año</th>';
        $html .= '<th>Fecha de Nacimiento</th>';
        $html .= '<th>Asistencias</th>';
        $html .= '<th>Promedio</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        $html .= '<tr>';
        $html .= '<td>' . $student->dni . '</td>';
        $html .= '<td>' . $student->name . ' ' . $student->surname . '</td>';
        $html .= '<td>' . $student->year . '</td>';
        $html .= '<td>' . date('d/m/Y', strtotime($student->birth)) . '</td>';
        $html .= '<td>' . $student->assists->count() . '</td>';
        $html .= '<td style="color:' . $color . ';">' . $promedio . '%</td>';
        $html .= '</tr>';
        $html .= '</tbody>';
        $html .= '</table>';

        if ($student->assists->isEmpty()) {
            $html .= '<h2 style="text-align:center;">No hay asistencias cargadas aún</h2>';
        } else {
            // Agrega la tabla con las fechas de asistencia
        $html .= '<h2 style="text-align:center;">Fechas de Asistencia</h2>';
        $html .= '<table border="1" style="width:100%; border-collapse: collapse; text-align:center;">';
        $html .= '<thead>';
        $html .= '<tr>';
        $html .= '<th>Fecha</th>';
        $html .= '<th>Hora</th>';
        $html .= '</tr>';
        $html .= '</thead>';
        $html .= '<tbody>';
        foreach ($student->assists as $assist) {
            $html .= '<tr>';
            $html .= '<td>' . date("d/m/Y", strtotime(substr($assist->assist, 0, 10))) . '</td>';
            $html .= '<td>' . substr($assist->assist, 10, 19) . '</td>';
            $html .= '</tr>';
        }
        $html .= '</tbody>';
        $html .= '</table>';
        }

        

        if ($notes->isEmpty()) {
            $html .= '<h2 style="text-align:center;">No hay notas cargadas aún</h2>';
        } else {
            // Agregar tabla de notas 
            $html .= '<h2 style="text-align:center;">Notas</h2>';
            $html .= '<table border="1" style="width:100%; border-collapse: collapse; text-align:center;">';
            $html .= '<thead>';
            $html .= '<tr>';
            $html .= '<th>Materia</th>';
            $html .= '<th>Nota</th>';
            $html .= '</tr>';
            $html .= '</thead>';
            $html .= '<tbody>';
            foreach ($notes as $note) {
                $html .= '<tr>';
                $html .= '<td>' . $note->subject . '</td>';
                $html .= '<td>' . $note->note . '</td>';
                $html .= '</tr>';
            }
            $html .= '</tbody>';
            $html .= '</table>';
        }



        // Crea una instancia de Dompdf
        $dompdf = new Dompdf();

        // Carga el contenido HTML en Dompdf
        $dompdf->loadHtml($html);

        // Renderiza el PDF
        $dompdf->render();

        // Devuelve el PDF como una respuesta HTTP
        return response($dompdf->output(), 200)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="estudiantes.pdf"');
    }
}


