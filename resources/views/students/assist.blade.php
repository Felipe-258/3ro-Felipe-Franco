@extends('students.layouts')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <div class="float-start">
                        Assist Information
                    </div>
                    <div class="float-end">
                        <a href="{{ route('students.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                    </div>
                </div>
                <div class="card-body">

                    <div class="row">
                        {{-- <label for="assist" class="col-md-4 col-form-label text-md-end text-start"></label> --}}
                        <div class="col-md-6 text-center" style="line-height: 35px;">
                            <p><strong>Nombre del estudiante:</strong> {{ $student->name }}</p>
                            <p><strong>Total de asistencias:</strong> {{ $total }}</p> 
                            <p style="color: {{ $color }}">
                                Promedio: {{ $promedio }}%
                            </p>
                            <p><strong>Total de clases:</strong> {{ $clases }}</p> 
                            {{-- <label for="assist" class="col-md-5 col-form-label text-md-end text-start"><strong>Condicion: {{ $total }} </strong> </label>  --}}
                            
                            <table class="table table-bordered table-hover" style="width: 200%">
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                </tr>
                                <tbody>
                                    
                                    @foreach ($assists as $dia)
                                        <tr>
                                            <td>
                                                <p>{{ date("d/m/y", strtotime(substr( $dia->assist, 0, 10))) }}</p>
                                                
                                            </td>
                                            <td>
                                                <p>{{ substr( $dia->assist, 10) }}</p>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
