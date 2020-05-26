@extends('layouts.main')

@section('content')
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-9 mt-2 ml-0 pr-2 pl-4 mb-2">
                @include('dashboard.bots')
            </div>
            <div class="col-md-3 pl-0 mt-2 pr-2">
                <div class="sticky-top">
                    <div class="card text-center mt-0 bg-dark text-white">
                        <div class="card-header bg-secondary">To withdraw</div>
                        <div class="card-body">
                            <h4>
                            <span class="badge badge-success">
                                {{$money_to_withdraw}}
                            </span>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center mt-2 bg-dark text-white">
                        <div class="card-header bg-secondary">Daily balance</div>
                        <div class="card-body">
                            <h4>
                            <span class="badge badge-success">
                                {{$daily_balance}}
                            </span>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center mt-2 bg-dark text-white">
                        <div class="card-header bg-secondary">Money in System / Average per Bot</div>
                        <div class="card-body">
                            <h4>
                                <span class="badge badge-secondary">
                                    {{$total_currency}}
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center bg-dark text-white mt-2">
                        <div class="card-header bg-secondary">Bots Requests / Average per Bot</div>
                        <div class="card-body">
                            <h4>
                            <span class="badge badge-secondary">
                                {{$requests}}
                            </span>
                                /
                                <span class="badge badge-secondary">
                                ≈ {{$requests_per_bot}}
                            </span>
                            </h4>
                        </div>
                    </div>
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