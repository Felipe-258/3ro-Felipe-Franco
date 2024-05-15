@extends('students.layouts')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">

            @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Edit student
                    </div>
                    <div class="float-end">
                        <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('students.update', $student->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row">
                            <label for="dni" class="col-md-4 col-form-label text-md-end text-start">dni</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('dni') is-invalid @enderror"
                                    id="dni" name="dni" value="{{ $student->dni }}">
                                @if ($errors->has('dni'))
                                    <span class="text-danger">{{ $errors->first('dni') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ $student->name }}">
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="surname" class="col-md-4 col-form-label text-md-end text-start">surname</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control @error('surname') is-invalid @enderror"
                                    id="surname" name="surname" value="{{ $student->surname }}">
                                @if ($errors->has('surname'))
                                    <span class="text-danger">{{ $errors->first('surname') }}</span>
                                @endif
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="assist" class="col-md-4 col-form-label text-md-end text-start">assist</label>
                            <div class="col-md-6">
                                <input type="number" step="0.01"
                                    class="form-control @error('assist') is-invalid @enderror" id="assist" name="assist"
                                    value="{{ $student->assist }}">
                                @if ($errors->has('assist'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                @endif
                            </div>
                        </div>


                        <div class="mb-3 row">
                            <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
