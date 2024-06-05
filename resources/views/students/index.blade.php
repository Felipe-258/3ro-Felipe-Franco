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
                <div class="d-flex justify-content-between mb-3">
                    <a href="{{ route('students.create') }}" class="btn btn-success btn-sm"><i class="bi bi-plus-circle"></i> Add New Student</a>
                    {{-- <form action="{{ route('assistForm.store') }}" method="post" class="form-inline">
                        @csrf
                        <div class="form-group mb-2">
                            <input type="text" class="form-control" id="dni" name="dni" placeholder="DNI">
                            @if ($errors->has('dni'))
                            <span class="text-danger">{{ $errors->first('dni') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary ml-2 mb-2">Add Assist</button>
                    </form> --}}
                </div>

                <form action="{{ route('students.filter') }}" method="GET" class="mb-3">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <input type="number" name="dni" id="dni" class="form-control" placeholder="DNI" value="{{ Session::get('dni') }}">
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="{{ Session::get('name') }}">
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="surname" id="surname" class="form-control" placeholder="Surname" value="{{ Session::get('surname') }}">
                        </div>
                        <div class="form-group col-md-2">
                            <select name="year" id="year" class="form-control">
                                <option value="">Empty</option>
                                <option value="3" {{ Session::get('year') == '3' ? 'selected' : '' }}>3ro</option>
                                <option value="2" {{ Session::get('year') == '2' ? 'selected' : '' }}>2do</option>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-2">
                            <button class="btn btn-info btn-block" type="submit">Filtrar</button>
                        </div>
                        <div class="form-group col-md-2">
                            <a href="{{ route('students.clearFilters') }}" class="btn btn-secondary btn-block">Limpiar Filtros</a>
                        </div>
                    </div>
                </form>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">DNI</th>
                            <th scope="col">Name</th>
                            <th scope="col">Surname</th>
                            <th scope="col">Year</th>
                            <th scope="col">Assist</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                        <tr>
                            <td>{{ $student->dni }}</td>
                            <td>{{ $student->name }}</td>
                            <td>{{ $student->surname }}</td>
                            <td>{{ $student->year . ($student->year == 2 ? 'do' : ($student->year == 3 ? 'ro' : '')) }}</td>
                            <td>{{ $student->assist }}</td>
                            <td>
                                <div style="display: inline-block;">
                                    <form action="{{ route('students.destroy', $student->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')

                                        <a href="{{ route('assist.show', $student->id) }}" class="btn btn-success btn-sm">
                                            <i class="bi bi-journal-text"></i> Assists
                                        </a>

                                        <a href="{{ route('students.show', $student->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-eye"></i> Show
                                        </a>

                                        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </a>
                                        <input type="hidden" name="" id="">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this student?');">
                                            <i class="bi bi-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                                <div style="display: inline-block;">
                                    <form action="{{ url('/exportar-pdf') }}" method="GET" target="_blank">
                                        <input type="hidden" name="id" id="id" value="{{ $student->dni }}">
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf-fill"></i> PDF</button>
                                    </form>
                                </div>
                                @php
                                $birthday = \Carbon\Carbon::parse($student->birth);
                                $now = now();
                                $isBirthday = $birthday->isBirthday($now);
                                @endphp

                                @if ($isBirthday)
                                <a href="https://www.youtube.com/watch?v=MP1G8wnLpSM" target="_blank" class="text-white btn btn-dark btn-sm">
                                    <i class="bi bi-cake"></i> hoy cumple <i class="bi bi-cake"></i>
                                </a>
                                @endif
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
    .form-inline .form-control {
        display: inline-block;
        width: auto;
        vertical-align: middle;
    }

    .form-inline .form-control[readonly],
    .form-inline .form-control[disabled] {
        background-color: transparent;
    }

    .form-inline .btn {
        vertical-align: middle;
    }

    .form-inline label {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .form-inline .form-group {
        margin-right: 10px;
    }

    .mb-2 {
        margin-bottom: .5rem !important;
    }

    .mb-3 {
        margin-bottom: 1rem !important;
    }

    .ml-2 {
        margin-left: .5rem !important;
    }

    .d-flex {
        display: flex !important;
    }

    .justify-content-between {
        justify-content: space-between !important;
    }

    .form-row {
        display: flex;
        align-items: center;
    }

    .form-group {
        margin-right: 20px;
    }
</style>
@endsection
