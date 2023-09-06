@extends('template.template')

@section('title')
    My favorites
@endsection

@section('content')
    @include('include.header')
    <?php if ($favorites) { $i = 1 ?>
    <div class="row">
        <div class="col-lg-7 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">My favorites Coins</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    @if (isset($error))
                                        <th class="text-center"> Coin </th>
                                    @else
                                        <th></th>
                                        <th>Coin</th>
                                        <th></th>
                                        <th></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($error))
                                    <tr>
                                        <td class="text-center"> <code>{{ $error }}</code></td>
                                    </tr>
                                @endif
                                @foreach ($favorites as $favorite)
                                    <tr>
                                        <td class="py-1">
                                            <?= $i ?>
                                        </td>
                                        <td>
                                            <?php if (isset($favorite) == true) { ?>
                                            <button class="mdi mdi-star" id="star_{{ $favorite['accronyme'] }}"
                                                style="color: yellow; font-size:1.5rem; background:none; border:none"
                                                onclick="deleteFavorite('{{ $favorite['accronyme'] }}')">
                                            </button>
                                            <?php  } ?>
                                        </td>
                                        <td>
                                            {{ $favorite['nameCoins'] }}
                                        </td>
                                        <td> <a href="{{ url('/coin/' . $favorite['accronyme']) }}" class="btn btn-info">
                                                View
                                                more</a> </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $favorites->links() }}
                    </div>
                </div>
            </div>
        </div>
        <?php  }  ?>
        <div class="col-lg-5 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tendance Coins</h4>
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th> Coin </th>
                                    <th> Prix </th>
                                    <th> 24h % </th>
                                    <th> Cap.Marché </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach ($allCoins as $coin)
                                    <?php if ($i >= 10) {
                                        break;
                                    } ?>
                                    <tr>
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
                                    </tr>
                                    <?php $i++; ?>
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
    <script src="{{ asset('assets/js/favorite/favorite.js') }}"></script>
@endsection
