@extends('template.template')

@section('title')
    Portfolio
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
@endsection
@section('content')
@dump($coinsWallet)
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card" style="height: auto">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="wrapper pb-5 border-bottom">
                            <div class="text-wrapper d-flex align-items-center justify-content-between mb-2">
                                <h3 class="mb-0">Total Portfolio</h3>
                                <h3 class="mb-0 font-weight-bold">$ 92556</h3>
                                <span class="text-success"><i class="mdi mdi-arrow-up"></i>2.95%</span>
                            </div>
                        </div>
                    </div>
                    <div>
                        <canvas id="areaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card" style="height: auto">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">List of your assets</h4>
                    <p class="card-description"> <code>Price is not always reliable </code>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-dark">
                            <thead>
                                <tr>
                                    <th> # </th>
                                    <th> Coins </th>
                                    <th> Amount </th>
                                    <th> Total </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($coinsWallet)
                                <?php $i = 1 ?>
                                    @foreach ($coinsWallet as $coin)
                                        <tr>
                                            <td> <?= $i ?> </td>
                                            <td> {{$coin['coins']}} </td>
                                            <td> {{$coin['totalCoins']}} </td>
                                            <td> May 15, 2015 </td>
                                        </tr>
                                        <?php $i++ ?>
                                    @endforeach
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    @if (Session('alert'))
                        <div class="alert alert-success" style="width: auto" id="alert">{{ Session::get('alert') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" id="alert">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif
                    <h4 class="card-title">Add new coin</h4>
                    <form class="forms-sample" method="POST" action="{{ url('/add-coin-wallet') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 grid-margin stretch-card">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Coins</label>
                                    <select class="js-example-basic-single" style="width:20rem" name="coin">
                                        @foreach ($allCoins as $coin)
                                            <option value="{{ $coin['accronyme'] }}">{{ $coin['coins'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Total Coins</label>
                                    <input type=number step=any class="form-control" placeholder="Total coins"
                                        name="total-coin">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-dark">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ url('assets/js/chart/portfolioChart.js') }}"></script>
    <script src="{{ url('assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/select2.js') }}"></script>
    <script src="{{ url('assets/js/alert/alert.js') }}"></script>
@endsection
