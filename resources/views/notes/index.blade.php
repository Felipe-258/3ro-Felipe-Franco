@extends('students.layouts')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Note List</div>
                <div class="card-body">
                    <a href="{{ route('notes.create') }}" class="btn btn-success btn-sm my-2"><i
                            class="bi bi-plus-circle"></i> Add New Note</a>
                    <table id="example" class="table table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th scope="col">DNI Student</th>
                                <th scope="col">Name</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($notes as $note)
                                <tr>
                                    <td>{{ $note->student->dni }}</td>
                                    <td>{{ $note->student->name . ' ' . $note->student->surname }}</td>
                                    <td>{{ $note->subject }}</td>
                                    <td>{{ $note->note }}</td>
                                    
                                    <td>
                                        <form action="{{ route('notes.destroy', $note->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <a href="{{ route('students.show', $note->student_id) }}"
                                                class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show Student</a>
                                            {{-- <a href="{{ route('notes.edit', $note->id) }}"
                                                class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a> --}}

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Do you want to delete this note?');"><i
                                                    class="bi bi-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="6">
                                    <span class="text-danger">
                                        <strong>No Note Found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $notes->links() }}

                </div>
            </div>
        </div>
    </div>
@endsection
