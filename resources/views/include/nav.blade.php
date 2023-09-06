<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <?php if (Auth::user() == true) { ?>

        <li class="nav-item profile">
            <div class="profile-desc">
                <div class="profile-pic">
                    <div class="profile-name">
                        <h5 class="mb-0 font-weight-normal">{{ $user['name'] }}</h5>
                    </div>
                </div>
            </div>
        </li>
        <?php } ?>
        <li class="nav-item nav-category">
            <span class="nav-link">Navigation</span>
        </li>
        <li class="nav-item menu-items">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-icon">
                    <i class="mdi mdi-bitcoin"></i>
                </span>
                <span class="menu-title">Coins</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ url('/home') }}">Tendance Coins</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ url('/allcoins') }}">All Coins</a></li>
                    <?php if (Auth::user() == true) { ?>
                    <li class="nav-item"> <a class="nav-link" href="{{url('/my-favorites')}}">My favorites</a></li>
                    <?php } ?>
                </ul>
            </div>
        </li>

        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/exchange/all') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-finance"></i>
                </span>
                <span class="menu-title">Exchange</span>
            </a>
        </li>


        {{-- <li class="nav-item menu-items">
            <a class="nav-link" href="{{ url('/portfolio') }}">
                <span class="menu-icon">
                    <i class="mdi mdi-wallet"></i>
                </span>
                <span class="menu-title">Portfolio</span>
            </a>
        </li> --}}
</nav>
