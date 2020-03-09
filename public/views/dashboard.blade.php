@extends('layouts.main')

@section('content')
        <table class="table table-dark table-hover">
            <thead>
            <tr class="text-center">
                <th>Id</th>
                <th>Seosprint Id</th>
                <th>Balance</th>
                <ht>Clicks</ht>
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
@endsection