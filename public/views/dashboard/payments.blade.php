<table id="payments-table" class="table table-dark table-hover">
    <thead>
    <tr class="text-center">
        <th>#</th>
        <th>Payeer Wallet</th>
        <th>Balance</th>
        <th>Updated</th>
    </tr>
    </thead>
    <tbody>
    @foreach($payments as $payment)
        <tr class="text-center">
            <td>{{$loop->iteration}}</td>
            <td>{{$payment->payeer_wallet}}</td>
            <td>{{$payment->amount}}</td>
            <td>
                {{
                    \Carbon\Carbon::parseFromLocale($payment->updated_at, 'PL')
                        ->setTimezone('Europe/Warsaw')->format('H:i:s d/m/Y')
                }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
