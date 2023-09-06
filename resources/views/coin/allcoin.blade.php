@extends('template.template')

@section('title')
    All coins
@endsection

@section('content')
    @include('include.header')
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">All coins</h4>
                <p class="card-description"> Beware of <code> scam </code>and <code>rugpull numbers</code>
                </p>
                <div class="table-responsive">
                    <table class="table table-striped" id="order-listing">
                        <thead>
                            <tr>
                                @if (Auth::check())
                                    <th></th>
                                @endif
                                <th> Name </th>
                                <th> NameSymbole </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allCoins as $coin)
                                <tr>
                                    @if (Auth::check())
                                        <td> <input class="star" type="checkbox" title="bookmark page" checked> </td>
                                    @endif
                                    <td> {{ $coin['coins'] }} </td>
                                    <td> {{ $coin['accronyme'] }} </td>
                                    <td> <a href="{{ url('/coin/' . $coin['coins']) }}" class="btn btn-primary"> View more</a>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $allCoins->links() }}
            </div>
        </div>
    </div>
@endsection


@section('script')
@endsection
