@extends('template.template')
@section('title')
    Home
@endsection
@section('content')
    @include('include.header')
    @if (Auth::check())
    @dump(Auth::user())

    @endif
    <div class="row">
        @foreach ($topCoin as $coin)
            <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div class="d-flex align-items-center align-self-start">
                                    <h3 class="mb-0">
                                        @if ($coin['symbol'] == 'btc')
                                            {{ number_format($coin['market_data']['current_price']['usd'], 0, '.', ',') }} $
                                        @else
                                            {{ number_format($coin['market_data']['current_price']['usd'], 2, '.', ',') }} $
                                        @endif
                                    </h3>
                                    @if ($coin['market_data']['price_change_percentage_24h'] > 0)
                                        <p class="text-success ml-2 mb-0 font-weight-medium">
                                            + {{ number_format($coin['market_data']['price_change_percentage_24h'], 2) }} %
                                            <small><em>24h</em></small>
                                        </p>
                                    @else
                                        <p class="text-danger ml-2 mb-0 font-weight-medium">
                                            {{ number_format($coin['market_data']['price_change_percentage_24h'], 2) }} %
                                            <small><em>24h</em></small>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-4">
                                @if ($coin['market_data']['price_change_percentage_24h'] > 0)
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
                        <div style="display:flex; flex-direct: column; ">
                            <img src="{{ $coin['image']['thumb'] }}" height="15px" width="15px" alt=""
                                srcset="">
                            <div class="ml-1"></div>
                            <h6 class=""> {{ $coin['name'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <th> Rank# </th>
                                    <th></th>
                                <th> Coin </th>
                                <th> Prix </th>
                                <th> 24h % </th>
                                <th> Cap.Marché </th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php $index = 0; ?>
                                @foreach ($allCoin as $coin)
                                    <tr>
                                        <td>
                                            <span>{{ $coin['market_cap_rank'] }}</span>
                                        </td>
                                            <td>
                                                <?php if (isset($userFavorites) == true) { ?>
                                                @if (!$userFavorites->contains('accronyme', $coin['id']))
                                                    <button class="mdi mdi-star-outline" id="star_outline_{{ $coin['id'] }}"
                                                        style="color: yellow; font-size:1.5rem; background:none; border:none";
                                                        onclick="addToFavorite('{{ $coin['id'] }}')">
                                                    </button>
                                                @else
                                                    <button class="mdi mdi-star" id="star_{{ $coin['id'] }}"
                                                        style="color: yellow; font-size:1.5rem; background:none; border:none"
                                                        onclick="deleteFavorite('{{ $coin['id'] }}')">
                                                    </button>
                                                @endif
                                                <?php  } ?>
                                            </td>
                                        <td> <img src="{{ $coin['image'] }}" alt="image" /> <span
                                                style="color: white">{{ $coin['name'] }}</span></td>
                                        <td>
                                            {{ $coin['current_price'] }} $
                                        </td>
                                        @if ($coin['price_change_percentage_24h'] > 0)
                                            <td class="text-success">
                                                {{ number_format($coin['price_change_percentage_24h'], 2) }}% <i
                                                    class="mdi mdi-arrow-up"></i></td>
                                        @elseif($coin['price_change_percentage_24h'] <= 0)
                                            <td class="text-danger">
                                                {{ number_format($coin['price_change_percentage_24h'], 2) }}% <i
                                                    class="mdi mdi-arrow-down"></i></td>
                                        @endif
                                        <td>
                                            {{ number_format($coin['market_cap'], 0, '.', ',') }} $
                                        </td>
                                        <td> <a href="{{ url('/coin/' . $coin['id']) }}"
                                                class="btn btn-primary btn-fw">Voir
                                                Plus</a>
                                        </td>
                                        <?php $index++; ?>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="assets/js/chart/homeChart.js"></script>
    @if ( session('accessToken') != null)
        <script>
            const token = "{{session('accessToken')}}";
            if (localStorage.getItem("api_token") == null) {
                localStorage.setItem('api_token', token);
            }
        </script>
    @endif
    <script src="assets/js/favorite/favorite.js"></script>
@endsection
