@extends('layouts.main')

@section('content')
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-9">
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
            </div>
            <div class="col-md-3 pl-0 mt-2">
                <div class="card text-center bg-dark text-white">
                    <div class="card-header">Balance</div>
                    <div class="card-body">{{json_decode($currency)}}</div>
                </div>
                <div class="card text-center mt-2 bg-dark text-white">
                    <div class="card-header">Clicks</div>
                    <div class="card-body">{{json_decode($clicks)}}</div>
                </div>
                <div class="card text-center bg-dark text-white mt-2">
                    <div class="card-header">Requests</div>
                    <div class="card-body">{{json_decode($requests)[0]->requests}}</div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var myTable = document.getElementById('bots-table');

        var dataTable = new DataTable(myTable, {
            sortable: true,
            searchable: false,
            perPage: 100
        });
    </script>
@endsection