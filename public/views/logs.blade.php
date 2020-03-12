@extends('layouts.main')

@section('content')
    <table id="logs-table" class="table table-dark table-hover">
        <thead>
        <tr class="text-center">
            <th>Id</th>
            <th>Message</th>
            <th>Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($logs as $log)
            <tr class="text-center">
                <td>{{$log->id}}</td>
                <td>{{$log->message}}</td>
                <td>{{\Carbon\Carbon::parseFromLocale($log->time, 'PL')->setTimezone('Europe/Warsaw')->toTimeString()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        var myTable = document.getElementById('logs-table');

        var dataTable = new DataTable(myTable, {
            sortable: true,
            searchable: false,
            perPage: 100,
        });
    </script>
@endsection