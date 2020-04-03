<table id="bots-table" class="table table-dark table-hover">
    <thead>
    <tr class="text-center">
        <th>Id</th>
        <th>Daily Balance</th>
        <th>Balance</th>
        <th>Clicks</th>
        <th>Bot Name</th>
        <th>Level</th>
        <th>Last Update</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bots as $bot)
        <tr @if($bot->balance >= 15.00) class="text-center bg-success"
            @elseif($bot->balance >= 14.00) class="text-center bg-success-part"
            @else class="text-center"
                @endif
        >
            <td>{{$bot->id}}</td>
            <td>{{round($bot->daily_balance, 2)}}</td>
            <td>{{$bot->balance}}</td>
            <td>{{$bot->clicks}}</td>
            <td>{{$bot->bot_name}}</td>
            <td>{{$bot->level}}</td>
            <td>
                {{
                    \Carbon\Carbon::parseFromLocale($bot->time, 'PL')
                        ->setTimezone('Europe/Warsaw')
                        ->toTimeString()
                }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
