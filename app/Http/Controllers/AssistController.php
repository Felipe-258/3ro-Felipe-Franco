<?php

namespace App\Http\Controllers;

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
    public function search (Request $request)
    {
        /* dd($request); */
        $request->validate([
            'dni' => 'required|integer|exists:students,dni',
        ]);
        
        $student = Student::where('dni', $request->dni)->first();

        /* return route('students.show', $student->id); */
        return redirect()->action(
            [StudentController::class, 'show'], ['student' => $student->id]
        );
    }
    public function show(Student $student): View
    {
        $total = DB::table('assists')->where('student_id', $student->id)->count();
        $assists = DB::table('assists')->where('student_id', $student->id)->get();
        $promedio = $total / 10;
        $promedio = $promedio * 100;
        $color = '';
        if ($promedio < 60) {
            $color = 'red';
        }
        if ($promedio >= 60 && $promedio < 80) {
            $color = 'blue';
        }
        if ($promedio >= 80) {
            $color = 'green'; 
        }
        /* dd($assists); */
        //           carpeta  archivo
        return view('students.assist', [
            'student' => $student,
            'total' => $total,
            'promedio' => $promedio,
            'color' => $color,
            'assists' => $assists
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
    /* dd($student); */
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