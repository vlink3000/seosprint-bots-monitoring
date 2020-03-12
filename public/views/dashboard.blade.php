@extends('layouts.main')

@section('content')
    <table id="bots-table" class="table table-dark table-hover">
        <thead>
        <tr class="text-center">
            <th>Id</th>
            <th>Seosprint Id</th>
            <th>Balance</th>
            <th>Clicks</th>
            <th>Bot Name</th>
            <th>Last Update</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bots as $bot)
            <tr class="text-center">
                <td>{{$bot->id}}</td>
                <td>{{$bot->seosprint_id}}</td>
                <td>{{$bot->balance}}</td>
                <td>{{$bot->clicks}}</td>
                <td>{{$bot->bot_name}}</td>
                <td>{{\Carbon\Carbon::parseFromLocale($bot->time, 'PL')->setTimezone('Europe/Warsaw')->toTimeString()}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <p class="text-center text-info mb-1">{{json_decode($requests)[0]->requests}}</p>
    <script>
        var myTable = document.getElementById('bots-table');

        var dataTable = new DataTable(myTable, {
            sortable: true,
            searchable: false,
            perPage: 100
        });
    </script>
@endsection