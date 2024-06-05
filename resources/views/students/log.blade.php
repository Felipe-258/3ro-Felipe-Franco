@extends('students.layouts')

@section('content')
    <div class="row justify-content-center mt-3">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">Log List</div>
                <div class="card-body">
                    <table id="example" class="table table-striped table-bordered" >
                        <thead>
                            <tr>
                                <th scope="col">User ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Accion</th>
                                <th scope="col">IP</th>
                                <th scope="col">Browser</th>
                                <th scope="col">Fecha</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $log)
                                <tr>
                                    <td>{{ $log->id_user }}</td>
                                    <td>{{ $log->name }}</td>
                                    <td>
                                        @if ($log->accion == 'alta')
                                            <span class="text-success"><strong>{{ $log->accion }} </strong></span>
                                        @elseif ($log->accion == 'baja')
                                            <span class="text-danger"><strong>{{ $log->accion }} </strong></span>
                                        @elseif ($log->accion == 'modificacion')
                                            <span class="text-warning"><strong>{{ $log->accion }} </strong></span>
                                        @else
                                            {{ $log->accion }}
                                        @endif
                                    </td>
                                    <td>{{ $log->ip }}</td>
                                    <td>{{ $log->browser }}</td>
                                    <td>{{ date("H:i:s d/m/y ", strtotime($log->fecha)) }}</td>
                                    
                                </tr>
                            @empty
                                <td colspan="6">
                                    <span class="text-danger">
                                        <strong>No log Found!</strong>
                                    </span>
                                </td>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- {{ $logs->links() }} --}}

                </div>
            </div>
        </div>
    </div>
@endsection
