<table id="bots-table" class="table table-dark table-hover">
    <thead>
    <tr class="text-center">
        <th>Id</th>
        <th>Bot Name</th>
        <th>Balance</th>
        <th>Level</th>
        <th>Last Update</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bots as $bot)
        <tr @if($bot->balance >= 0.2000) class="text-center bg-success-done"
            @elseif($bot->balance >= 0.1957) class="text-center bg-success-part"
            @else class="text-center"
                @endif
        >
            <td>{{$bot->id}}</td>
            <td>{{$bot->bot_name}}</td>
            <td>{{$bot->balance}}</td>
            <td>{{$bot->level}}</td>
            <td>
                {{
                    \Carbon\Carbon::parseFromLocale($bot->last_request_at, 'PL')
                        ->setTimezone('Europe/Warsaw')
                        ->toTimeString()
                }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
