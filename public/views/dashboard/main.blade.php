@extends('layouts.main')

@section('content')
    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col-md-9 mt-2 ml-0 pr-2 pl-4 mb-2">
                @include('dashboard.bots')
            </div>
            <div class="col-md-3 pl-0 mt-2 pr-2">
                <div class="sticky-top">
                    <ul class="list-group mb-2">
                        <li class="list-group-item bg-success text-white text-center">
                            To withdraw: {{$money_to_withdraw}}
                        </li>
                    </ul>
                    <div class="card text-center bg-dark text-white mb-2">
                        <div class="card-header bg-secondary">Today monthly Revenue</div>
                        <div class="card-body">
                            <h4>
                            <span class="badge badge-secondary mt-2">
                                ≈ {{round($daily_currency * Carbon\Carbon::now()->daysInMonth, 2)}} RUB
                            </span>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center bg-dark text-white">
                        <div class="card-header bg-secondary">Daily Balance / Average per Bot</div>
                        <div class="card-body">
                            <h4>
                            <span class="badge badge-secondary">
                                {{json_decode(round($daily_currency, 2))}}
                            </span>
                                /
                                <span class="badge badge-danger">
                               ≈ {{round(json_decode(round($daily_currency, 2))/$bots_count, 2)}}
                            </span>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center mt-2 bg-dark text-white">
                        <div class="card-header bg-secondary">Money in System / Average per Bot</div>
                        <div class="card-body">
                            <h4>
                            <span class="badge badge-secondary">
                                {{json_decode(round($currency, 2))}}
                            </span>
                                /
                                <span class="badge badge-secondary">
                                ≈ {{json_decode(round($currency/$bots_count, 2))}}
                            </span>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center mt-2 bg-dark text-white">
                        <div class="card-header bg-secondary">Daily Adverts / Average per Bot</div>
                        <div class="card-body">
                            <h4>
                            <span class="badge badge-danger">
                                {{json_decode($clicks)}}
                            </span>
                                /
                                <span class="badge badge-secondary">
                                ≈ {{json_decode(round($clicks/$bots_count))}}
                            </span>
                            </h4>
                        </div>
                    </div>
                    <div class="card text-center bg-dark text-white mt-2">
                        <div class="card-header bg-secondary">Bots Requests / Average per Bot</div>
                        <div class="card-body">
                            <h4>
                            <span class="badge badge-secondary">
                                {{json_decode($requests)[0]->requests}}
                            </span>
                                /
                                <span class="badge badge-secondary">
                                ≈ {{round(json_decode($requests)[0]->requests/$bots_count)}}
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