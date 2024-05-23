<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Assist;
use App\Models\Note;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Support\Facades\DB;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        return view('students.index', [
            'students' => Student::latest()->paginate(10)
        ]);
        
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create() : View
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request) : RedirectResponse
    {
        $birth = $request->input('birth');
        $now = now();
        $age = $now->diffInYears($birth);
        /* dd($age); */
      
        if ($age>=18) {
            $data = $request->except('_token');
        Student::create($data);
        return redirect()->route('students.index')
                ->withSuccess('New Student is added successfully.');
        } else {
            return redirect()->back()->with('message', "Error. The student is too young.");
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student) : View
{
   /*  return view('students.show', [
        'student' => $student
    ]); */
    /* dd($student->id); */
    /* $student = Student::with('notes')->get(); */
    $student = Student::where('id', $student->id)->first();
    /* $notes = Note::where('student_id', $student->id); */
    $notes = DB::select("SELECT note, subject FROM notes where student_id=$student->id");
    /* dd($notes); */
        return view('students.show', [
            'student' => $student,
            'notes' => $notes,
        ]);
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student) : View
    {
        return view('students.edit', [
            'student' => $student
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student) : RedirectResponse
    {
        $data = $request->except('_token');
        $student->update($data);
        dd($student);
        return redirect()->back()
                ->withSuccess('Student is updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student) : RedirectResponse
    {
        $student->delete();
        return redirect()->route('students.index')
                ->withSuccess('Student is deleted successfully.');
    }

    /* public function average($id) {
        $total = DB::select("SELECT COUNT(*) as count FROM notes where student_id=$id");
        return view('assist', compact('total'));
    } */
}
