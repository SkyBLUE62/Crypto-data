@extends('template.template')

@section('title')
    Best Exchange
@endsection
@section('content')
    @include('include.header')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                        <div class="card-body">
                            <div class="row">
                                <h5>Market cap total</h5>
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        <h3 class="mb-0">
                                            {{ number_format($globalData['data']['total_market_cap']['usd'], 0, ',', '.') }}
                                            $
                                        </h3>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="icon icon-box-success ">
                                        <span class="mdi mdi-arrow-top-right icon-item"></span>
                                    </div>
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">The global crypto market cap</h6>
                        </div>
                    </div>

                    <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                        <div class="card-body">
                            <div class="row">
                                <h5>Market cap change <em><small>24h</small></em></h5>
                                <div class="col-9">
                                    <div class="d-flex align-items-center align-self-start">
                                        @if (number_format($globalData['data']['market_cap_change_percentage_24h_usd'], 2, ',', '.') > 0)
                                            <h3 class="mb-0 text-success ml-2 mb-0">
                                                {{ number_format($globalData['data']['market_cap_change_percentage_24h_usd'], 2, ',', '.') }}
                                                %</h3>
                                        @else
                                            <h3 class="mb-0 text-danger ml-2 mb-0">
                                                {{ number_format($globalData['data']['market_cap_change_percentage_24h_usd'], 2, ',', '.') }}
                                                %</h3>
                                        @endif

                                    </div>
                                </div>
                                <div class="col-3">
                                    @if (number_format($globalData['data']['market_cap_change_percentage_24h_usd'], 2, ',', '.') > 0)
                                        <div class="icon icon-box-success ">
                                            <span class="mdi mdi-arrow-top-right icon-item"></span>
                                        </div>
                                    @else
                                        <div class="icon icon-box-danger ">
                                            <span class="mdi mdi-arrow-bottom-left icon-item"></span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <h6 class="text-muted font-weight-normal">Last update
                                {{ date('Y-m-d H:i', $globalData['data']['updated_at']) }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h4 class="card-title">Best Exchange</h4>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th> </th>
                                    <th> Name </th>
                                    <th> Trust Score </th>
                                    <th> Country </th>
                                    <th> Creation date</th>
                                    <th> Trade Volume 24h </th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                @foreach ($dataExchange as $exchange)
                                    <tr>
                                        <td><?= $i ?></td>
                                        <td class="py-1">
                                            <img src="{{ $exchange['image'] }}" alt="image" />
                                        </td>
                                        <td> {{ $exchange['name'] }} </td>
                                        <td>
                                            <div class="progress">
                                                @if ($exchange['trust_score'] <= 10 && $exchange['trust_score'] > 7)
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        {{ $exchange['trust_score'] }}
                                                    </div>
                                                @elseif($exchange['trust_score'] <= 7 && $exchange['trust_score'] >= 5)
                                                    <div class="progress-bar bg-warning" role="progressbar"
                                                        style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        {{ $exchange['trust_score'] }}
                                                    </div>
                                                @elseif ($exchange['trust_score'] < 5)
                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                        style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        {{ $exchange['trust_score'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            @if ($exchange['country'] == null || $exchange['country'] == '')
                                                Unknown
                                            @else
                                                {{ $exchange['country'] }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($exchange['year_established'] == null || $exchange['year_established'] == '')
                                                Unknown
                                            @else
                                                {{ $exchange['year_established'] }}
                                            @endif
                                        </td>
                                        <td> {{ number_format($exchange['trade_volume_24h_btc'] * $dataBTC['market_data']['current_price']['usd'], 0, ',', '.') }}
                                            $</td>
                                        <td>
                                            @if ($exchange['name'] != 'Kraken' && $exchange['url'] != null)
                                                <a href="{{ $exchange['url'] }}" class="btn btn-primary">Trade</a>
                                            @elseif ($exchange['name'] != 'Kraken' || $exchange['url'] != null)
                                                <span class="btn btn-danger">Unknown</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Transaction History</h4>
                        <canvas id="market_cap_percentage" class="transaction-chart"></canvas>
                        <?php $i = 0; ?>
                        @foreach ($globalData['data']['market_cap_percentage'] as $market_cap_percentage)
                            <div
                                class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                <div class="text-md-center text-xl-left">
                                    @if ($i == 0)
                                        <h6 class="mb-1"> BTC Dominance</h6>
                                    @elseif($i == 1)
                                        <h6 class="mb-1"> ETH Dominance</h6>
                                    @elseif($i == 2)
                                        <h6 class="mb-1"> USDT Dominance</h6>
                                    @elseif($i == 3)
                                        <h6 class="mb-1"> BNB Dominance</h6>
                                    @elseif($i == 4)
                                        <h6 class="mb-1"> USDC Dominance</h6>
                                    @elseif($i == 5)
                                        <h6 class="mb-1"> XRP Dominance</h6>
                                    @elseif($i == 6)
                                        <h6 class="mb-1"> BUSD Dominance</h6>
                                    @elseif($i == 7)
                                        <h6 class="mb-1"> ADA Dominance</h6>
                                    @elseif($i == 8)
                                        <h6 class="mb-1"> DOGE Dominance</h6>
                                    @elseif($i == 9)
                                        <h6 class="mb-1"> MATIC Dominance</h6>
                                    @endif
                                </div>
                                <div
                                    class="align-self-center flex-grow text-right text-md-center text-xl-right py-md-2 py-xl-0">
                                    <h6 class="font-weight-bold mb-0">{{ number_format($market_cap_percentage, 2) }} %</h6>
                                </div>
                            </div>
                            <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php $i = 1; ?>
    @foreach ($globalData['data']['market_cap_percentage'] as $data)
        <input type="hidden" value="{{ number_format($data, 2) }}" id="market_cap_percentage_<?= $i ?>">
        @if ($i >= 8)
        <?php break; ?>
      @endif
        <?php $i++; ?>
    @endforeach
    <input type="hidden" value="{{$globalData['data']['total_market_cap']['usd']}}" id="total_market_cap">
@endsection

@section('script')
    <script src="{{ asset('assets/js/chart/marketCapPercentage.js') }}"></script>
@endsection
