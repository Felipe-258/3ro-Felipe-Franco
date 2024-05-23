@extends('students.layouts')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

            <div class="card">
                <div class="card-header">Student List</div>
                <div class="card-body">

                    <div class="button-grid">
                        <a href="{{ route('students.create') }}" class="btn btn-success btn-sm my-3"><i
                                class="bi bi-plus-circle"></i> Add New Student</a>
                        <a href="{{ route('assist.form') }}" class="btn btn-success btn-sm my-3"><i
                                class="bi bi-plus-circle"></i> Add New Assist</a>
                        <a href="{{ route('notes.create') }}" class="btn btn-success btn-sm my-3"><i
                                class="bi bi-plus-circle"></i> Add New Note</a>
                        {{-- <div class="button">
                            <div class="separador"></div>
                        </div> --}}


                        <div class="button">

                            <form action="{{ route('assistForm.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <label for="dni"
                                        class="fuente col-md-6  col-form-label text-md-end text-start ">Asistencia
                                        Rapida</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control " id="dni" name="dni"
                                            placeholder="dni">
                                        @if ($errors->has('dni'))
                                            <span class="text-danger">{{ $errors->first('dni') }}</span>
                                        @endif
                                    </div>
                                </div>
                        </div>
                        <div class="button">
                            <div class="mb-3 row offset-md-2">
                                <button type="submit" class="col-md-6  btn btn-primary " value="Add Assist"> Add
                                    Assist</button>
                                {{-- <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Assist"> --}}
                            </div>
                            </form>
                        </div>
                    </div>



                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                {{-- <th scope="col">S#</th> --}}
                                <th scope="col">DNI</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Assist</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $student)
                                <tr>
                                    {{-- <th scope="row">{{ $loop->iteration }}</th> --}}
                                    <td>{{ $student->dni }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->surname }}</td>
                                    <td>{{ $student->assist }}</td>
                                    <td>
                                        <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')


                                            <a href="{{ route('assist.show', $student->id) }}"
                                                class="btn btn-success btn-sm"><i class="bi bi-journal-text"></i>
                                                Assists</a>

                                            <a href="{{ route('students.show', $student->id) }}"
                                                class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                            <a href="{{ route('students.edit', $student->id) }}"
                                                class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>

                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Do you want to delete this student?');"><i
                                                    class="bi bi-trash"></i> Delete</button>

                                            @php
                                                $birthday = \Carbon\Carbon::parse($student->birth);
                                                $now = now();
                                                $isBirthday = $birthday->isBirthday($now);
                                            @endphp

                                            @if ($isBirthday)
                                                <a href="https://www.youtube.com/watch?v=MP1G8wnLpSM" target="_blank" class="text-white btn btn-dark btn-sm"><i class="bi bi-cake"></i> hoy cumple <i class="bi bi-cake"></i></a>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="6">
                                    <span class="text-danger">
                                        <strong>No student Found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                    </table>

                    {{ $students->links() }}

                </div>
            </div>
        </div>
    </div>
    <style>
        .button-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 10px;
        }

        .separador {
            width: 2px;
        }

        .fuente {
            font-size: 13px;
        }
    </style>
@endsection
