<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Assist;
use App\Http\Requests\StoreAssistRequest;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class AssistController extends Controller
{
    public function search(Request $request)
    {
        /* dd($request); */
        $request->validate([
            'dni' => 'required|integer|exists:students,dni',
        ]);

        $student = Student::where('dni', $request->dni)->first();

        /* return route('students.show', $student->id); */
        return redirect()->action(
            [StudentController::class, 'show'],
            ['student' => $student->id]
        );
    }

    
    public function show(Student $student): View
    {
        $total = DB::table('assists')->where('student_id', $student->id)->count();
        $assists = DB::table('assists')->where('student_id', $student->id)->get();
        $parameters = DB::table('parameters')->first();
        $promedioCrudo = $total / $parameters->total;
        $promedioCrudo = $promedioCrudo * 100;
        $promedio = round($promedioCrudo, 3); // Truncamos a tres dígitos después de la coma
        $color = '';
        
        if ($promedio < $parameters->regular) {
            $color = 'red';
        }
        if ($promedio >= ($parameters->regular) && $promedio < ($parameters->promocion)) {
            $color = 'blue';
        }
        if ($promedio >= $parameters->promocion) {
            $color = 'green';
        }
        /* dd($assists); */
        //           carpeta  archivo
        return view('students.assist', [
            'student' => $student,
            'total' => $total,
            'promedio' => $promedio,
            'color' => $color,
            'assists' => $assists,
            'clases' => $parameters->total,
        ]);

    }
    public function store(Request $request)
    {
        /* dd($request); */
        $request->validate([
            'dni' => 'required|integer|exists:students,dni',
        ]);
        // Verifica si el estudiante existe sino, lanza una excepción
        /* $student = Student::findOrFail($request->input('student_id')); */
        $student = Student::where('dni', $request->dni)->first();
        $now = now();
        $hoy = substr($now, 0, 10);

        $assist = DB::select("select * from assists where student_id = $student->id and DATE(assist) = ?", [$hoy]);
        /* dd($assist); */
        if ($assist) {
            return redirect()->back()->with('message', "Error. The student assistant is already registered total.");            
        } else {
            
            $newAssist = new Assist();
            $newAssist->student_id = $student->id;
            $newAssist->assist = now();
            $newAssist->save();
            Student::where('dni', $request->dni)
                ->update(['assist' => $student->assist + 1]);
            return redirect()->route('students.index')
                ->withSuccess('New Assist registered successfully.');
        }

    }
}