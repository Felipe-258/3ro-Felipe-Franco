@extends('students.layouts')

@section('content')

<div class="row justify-content-center mt-3">
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="col-md-8">

        <div class="card">
            <div class="card-header">
                <div class="float-start">
                    Edit Parameters
                </div>
                <div class="float-end">
                    <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('parameter.update') }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" value="{{ $parameter->id }}" id="id" name="id">
                    <div class="mb-3 row">
                        <label for="total" class="col-md-4 col-form-label text-md-end text-start">total</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control @error('total') is-invalid @enderror" id="total" name="total" value="{{ $parameter->total   }}">
                            @if ($errors->has('total'))
                                <span class="text-danger">{{ $errors->first('total') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="promocion" class="col-md-4 col-form-label text-md-end text-start">promocion</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control @error('promocion') is-invalid @enderror" id="promocion" name="promocion" value="{{ $parameter->promocion }}">
                            @if ($errors->has('promocion'))
                                <span class="text-danger">{{ $errors->first('promocion') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="regular" class="col-md-4 col-form-label text-md-end text-start">regular</label>
                        <div class="col-md-6">
                          <input type="number" class="form-control @error('regular') is-invalid @enderror" id="regular" name="regular" value="{{ $parameter->regular }}">
                            @if ($errors->has('regular'))
                                <span class="text-danger">{{ $errors->first('regular') }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update Parameters">
                    </div>
                    
                </form>
            </div>
        </div>
    </div>    
</div>
    
@endsection