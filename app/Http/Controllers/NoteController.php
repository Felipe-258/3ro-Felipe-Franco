<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : View
    {
        /* $notes = Note::all();
        $students = Student::all(); */
        /* return ($notes); */
        $notes = Note::with('student')->get();
        return view('notes.index', [
            'notes' => Note::latest()->paginate(10)/* ,
            'student' => $students, */
        ]);
        /* return view('notes.index', [
            'notes' => Note::latest()->paginate(15)
        ]); */
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $note = $request->input('note');
        /* dd($request->dni); */
        /* $student = Student::find($request->dni); */
        $student = DB::select('select * from students where dni = :dni', ['dni' => $request->dni]);
        /* dd($student[0]->id); */
        if ($note>=1) {
            $newNote = new Note();
            $newNote->student_id = $student[0]->id;
            $newNote->note = $note;
            $newNote->subject = $request->input('subject');
            $newNote->save();
            return redirect()->route('notes.index')
                ->withSuccess('New Note is added successfully.');
        } else {
            return redirect()->back()->with('message', "Error. The Note is too low.");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note) : View
    {
        return view('notes.show', [
            'note' => $note
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note) : RedirectResponse
    {
        $note->delete();
        return redirect()->route('notes.index')
                ->withSuccess('note is deleted successfully.');
    }
}
