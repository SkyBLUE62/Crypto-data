@extends('template.template')
@section('title')
    Cours du {{ $detailCoin['name'] }} ({{ $detailCoin['symbol'] }}) | Graphique, Capitalisation...
@endsection
@section('content')
    @include('include.header')
    <div class="row" style="height: auto">
        <div class="col-md-9">
            <div class="card" style="height: 37vh">
                <div class="card-body">
                    <h1> <img src="{{ $detailCoin['image']['thumb'] }}" alt="" srcset="">
                        {{ $detailCoin['name'] }}</h1>
                    <div class="row">
                        <div class="col-sm-4 grid-margin">
                            <h5>Price</h5>
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <h5 class="mb-0">
                                            @if ($detailCoin['market_data']['current_price']['usd'] >= 100)
                                                {{ $detailCoin['market_data']['current_price']['usd'] }}$
                                            @else
                                                {{ $detailCoin['market_data']['current_price']['usd'] }}$
                                            @endif
                                        </h5>
                                        @if ($detailCoin['market_data']['price_change_percentage_24h'] > 0)
                                            <p class="text-success ml-2 mb-0 font-weight-medium">
                                                +
                                                {{ number_format($detailCoin['market_data']['price_change_percentage_24h'], 2) }}
                                                % <small><em>24h</em></small>
                                            </p>
                                        @else
                                            <p class="text-danger ml-2 mb-0 font-weight-medium">
                                                {{ number_format($detailCoin['market_data']['price_change_percentage_24h'], 2) }}
                                                % <small><em>24h</em></small>
                                            </p>
                                        @endif
                                    </div>
                                    <h6 class="text-muted font-weight-normal">
                                        @if (number_format($detailCoin['market_data']['price_change_percentage_30d'], 2) > 0)
                                            +
                                        @else
                                            -
                                        @endif
                                        {{ number_format($detailCoin['market_data']['price_change_percentage_30d'], 2, '.', ',') }}%
                                        Since last month
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 grid-margin">
                            <h5>Marcketcap</h5>
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <h5 class="mb-0">
                                            {{ number_format($detailCoin['market_data']['market_cap']['usd'], 0, '.', ',') }}$
                                        </h5>
                                        @if ($detailCoin['market_data']['market_cap_change_percentage_24h'] > 0)
                                            <p class="text-success ml-2 mb-0 font-weight-medium">
                                                +
                                                {{ number_format($detailCoin['market_data']['market_cap_change_percentage_24h'], 2) }}
                                                % <small><em>24h</em></small>
                                            </p>
                                        @else
                                            <p class="text-danger ml-2 mb-0 font-weight-medium">
                                                {{ number_format($detailCoin['market_data']['market_cap_change_percentage_24h'], 2) }}
                                                % <small><em>24h</em></small>
                                            </p>
                                        @endif
                                    </div>
                                    <h6 class="text-muted font-weight-normal">The total market value of a cryptocurrency's
                                        circulating supply</h6>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 grid-margin">
                            <h5>ATH</h5>
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="d-flex d-sm-block d-md-flex align-items-center">
                                        <h5 class="mb-0">{{ $detailCoin['market_data']['ath']['usd'] }}
                                            $</h5>
                                        @if ($detailCoin['market_data']['ath_change_percentage']['usd'] > 0)
                                            <p class="text-success ml-2 mb-0 font-weight-medium">
                                                {{ number_format($detailCoin['market_data']['ath_change_percentage']['usd'], 2) }}
                                                %
                                            </p>
                                        @else
                                            <p class="text-danger ml-2 mb-0 font-weight-medium">
                                                {{ number_format($detailCoin['market_data']['ath_change_percentage']['usd'], 2) }}
                                                %
                                            </p>
                                        @endif
                                    </div>
                                    <h6 class="text-muted font-weight-normal">Last ATH
                                        <?= date('F d, Y', strtotime($detailCoin['market_data']['ath_date']['usd'])) ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Offre en circulation </h5>
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="">
                                        <h6 class="text-center">
                                            @if ($detailCoin['market_data']['max_supply'] != null)
                                                <span class="text-center"> Max : <br>
                                                    {{ number_format($detailCoin['market_data']['max_supply'], 0, '.', ',') }}
                                                </span>
                                            @else
                                                Max : <br>
                                                Unlimited
                                            @endif
                                        </h6>
                                    </div>
                                    @if ($detailCoin['market_data']['max_supply'] != null)
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" id="progressBarSupply"
                                                aria-valuenow="{{ ($detailCoin['market_data']['circulating_supply'] * 100) / $detailCoin['market_data']['max_supply'] }}"
                                                aria-valuemin="0" aria-valuemax="100">
                                                {{ number_format(($detailCoin['market_data']['circulating_supply'] * 100) / $detailCoin['market_data']['max_supply'], 2, '.', ',') }}
                                                %
                                            </div>
                                        </div>
                                        <h6 class="mt-2 text-center">
                                            En circulation : <br>
                                            {{ number_format($detailCoin['market_data']['circulating_supply'], 0, '.', ',') }}
                                        </h6>
                                    @else
                                        <div class="progress">
                                            <div class="progress-bar bg-primary" role="progressbar" id="progressBarSupply"
                                                aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                                Unlimited
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <?php if (isset($detailCoin['market_data']['high_24h']['usd']) == true) { ?>
                        <div class="col-md-6">
                            <h5>Top <small><em>24h</em></small> </h5>
                            <div class="row">
                                <div class="col-8 col-sm-12 col-xl-8 my-auto">
                                    <div class="">
                                        <h6 class="text-center">
                                            Bas : <br>
                                            {{ $detailCoin['market_data']['low_24h']['usd'] }} $
                                        </h6>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar bg-primary" role="progressbar" id="progressBarTopBot"
                                            aria-valuenow="{{ ($detailCoin['market_data']['low_24h']['usd'] * 100) / $detailCoin['market_data']['high_24h']['usd'] }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format(($detailCoin['market_data']['low_24h']['usd'] * 100) / $detailCoin['market_data']['high_24h']['usd'], 2, '.', ',') }}
                                            %
                                        </div>
                                    </div>
                                    <h6 class="mt-2 text-center">
                                        Haut : <br>
                                        {{ $detailCoin['market_data']['high_24h']['usd'] }} $
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <?php } else { ?>
                        <div class="col-md-6">
                            <h5>No data <code>Scam Alert</code> </h5>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if (isset($detailCoin['sentiment_votes_up_percentage']) == true) { ?>
        <div class="col-md-3">
            <div class="card" style="height: 37vh">
                <div class="card-body">
                    <h4 class="card-title">
                        What do people think of {{ $detailCoin['name'] }}?
                        @if ($detailCoin['sentiment_votes_down_percentage'] == 100 || $detailCoin['sentiment_votes_up_percentage'] == 100)
                            <br> <code>The data is potentially wrong</code>
                        @endif
                    </h4>
                    <canvas id="doughnutChart" style="height:250px"></canvas>
                    @if ($detailCoin['sentiment_votes_down_percentage'] >= 90)
                        <div class="progress mt-3">
                            <div class="progress-bar bg-danger" id="progressBarVote" role="progressbar"
                                aria-valuenow="{{ $detailCoin['sentiment_votes_down_percentage'] }}" aria-valuemin="0"
                                aria-valuemax="100">
                                <span>{{ $detailCoin['sentiment_votes_down_percentage'] }}% Bad</span>
                            </div>
                        </div>
                    @else
                        <div class="progress mt-3">
                            <div class="progress-bar bg-primary" id="progressBarVote" role="progressbar"
                                aria-valuenow="{{ $detailCoin['sentiment_votes_up_percentage'] }}" aria-valuemin="0"
                                aria-valuemax="100">
                                <span>{{ $detailCoin['sentiment_votes_up_percentage'] }}% Good</span>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <?php   } else { ?>
        <div class="col-md-3">
            <div class="card" style="height: 37vh">
                <div class="card-body">
                    <h4 class="card-title">No data found for {{ $detailCoin['name'] }} <br> <code> potential scam</code>
                    </h4>
                </div>
            </div>
        </div>
        <?php  } ?>

    </div>
    <div class="row mt-3">
        <div class="col-md-8"  style="height: auto">
            <div class="card">
                <div style="display: flex; flex-direction:row; justify-content: right;">
                    <div class="btn-group mt-2 mr-2">
                        <button type="button" class="btn btn-secondary" id="btn_dropdown_chart"></button>
                        <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split"
                            id="dropdownMenuSplitButton4" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuSplitButton4">
                            <button class="dropdown-item" id="btn_dropdown_chart24h">24h</button>
                            <button class="dropdown-item" id="btn_dropdown_chart7j">7j</button>
                            <button class="dropdown-item" id="btn_dropdown_chart30j">30j</button>
                            @if ($detailCoin['genesis_date'] != null || $detailCoin['genesis_date'] != '')
                                <button class="dropdown-item" id="btn_dropdown_chartAll">All</button>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="loader" id="loader">
                        <div class="spinner">
                        </div>
                        <div class="cooldown" id="cooldown">

                        </div>
                    </div>
                    <div id="div_chart_24h">
                        <canvas id="chart24h" style="height:300px"></canvas>
                    </div>
                    <div id="div_chart_7j" style="display: none">
                        <canvas id="chart7j" style="height:300px"></canvas>
                    </div>
                    <div id="div_chart_30j" style="display: none">
                        <canvas id="chart30j" style="height:300px"></canvas>
                    </div>
                    @if ($detailCoin['genesis_date'] != null || $detailCoin['genesis_date'] != '')
                        <div id="div_chart_all" style="display: none">
                            <canvas id="chartAll" style="height:300px"></canvas>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="height: auto">
                    <a class="twitter-timeline" data-width="500" data-height="545px" data-theme="dark"
                        href="https://twitter.com/{{ $detailCoin['links']['twitter_screen_name'] }}?ref_src=twsrc%5Etfw">Tweets
                        by {{ $detailCoin['links']['twitter_screen_name'] }}</a>
                    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                </div>
            </div>
        </div>
    </div>
    @if ($detailCoin['description']['en'] != null)
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <h6 class="card-title mt-2 ml-2">What is {{ $detailCoin['name'] }} ?</h6>
                    <div class="card-body" style="height: auto">
                        <p class="text-justify">{{ strip_tags($detailCoin['description']['en']) }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Or trade safely? </h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th> Exchange </th>
                                    <th> Pair </th>
                                    <th> Security </th>
                                    <th> Price </th>
                                    <th> Volume(24h) </th>
                                    <th>Trade</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($detailCoin['tickers'] as $tickers)
                                    @if (strlen($tickers['base']) <= 10 && strlen($tickers['target']) <= 10)
                                        @if ($tickers['trade_url'] != null || $tickers['trade_url'] != '')
                                        <?php $i++; ?>
                                            <tr>
                                                <td class="py-1">
                                                    {{ $tickers['market']['name'] }}
                                                </td>
                                                <td> {{ $tickers['base'] . '-' . $tickers['target'] }} </td>
                                                <td>
                                                    <div class="progress">
                                                        @if ($tickers['trust_score'] == 'green')
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                Safe
                                                            </div>
                                                        @elseif ($tickers['trust_score'] == 'yellow')
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                Risk
                                                            </div>
                                                        @elseif($tickers['trust_score'] == 'red')
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                Scam Alert
                                                            </div>
                                                        @elseif($tickers['trust_score'] == '' || $tickers['trust_score'] == null)
                                                            <div class="progress-bar bg-info" role="progressbar"
                                                                style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                                aria-valuemax="100">
                                                                No data (Potentiel Scam)
                                                            </div>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>{{ $tickers['last'] . ' ' . $tickers['target'] }} </td>
                                                <td> {{ number_format($tickers['converted_volume']['usd'], 0, ',', '.') }}$
                                                </td>
                                                <th><a href="{{ url($tickers['trade_url']) }}"
                                                        class="btn btn-primary">Trade</a></th>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                                @if ($i == 0)
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td> <code> No data </code></td>
                                    <td>
                                    </td>
                                    <td></td>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($detailCoin['market_data']['max_supply'] == null)
        <input type="hidden" value="unlimited" id="maxSupply">
    @else
        <input type="hidden" value="{{ $detailCoin['market_data']['max_supply'] }}" id="maxSupply">
    @endif

    <input type="hidden" value="{{ $detailCoin['id'] }}" id="idCoin">
    <input type="hidden" value="{{ $detailCoin['market_data']['circulating_supply'] }}" id="circulatingSupply">
    <input type="hidden" value="{{ $detailCoin['sentiment_votes_up_percentage'] }}" id="sentiment_votes_up">
    <input type="hidden" value="{{ $detailCoin['sentiment_votes_down_percentage'] }}" id="sentiment_votes_down">

    @isset($detailCoin['market_data']['low_24h']['usd'])
        <input type="hidden" value="{{ $detailCoin['market_data']['low_24h']['usd'] }}" id="low_24h">
        <input type="hidden" value="{{ $detailCoin['market_data']['high_24h']['usd'] }}" id="high_24h">
    @endisset
@endsection
@section('script')
    <script src="{{ asset('assets/js/chart/coinChart.js') }}"></script>
    <script src="{{ asset('assets/js/progressBar/AnimeProgressBar.js') }}"></script>
@endsection
