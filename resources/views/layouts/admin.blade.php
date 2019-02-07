<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noodp"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
    <style>
        .fixed-width {
            font-family: 'Courier New';
        }
        .navbar-collaps.collapse.show .navbar-nav.mr-auto li.nav-item.dropdown:first-of-type {
            margin-top: 10px;
        }
        td.details-control .fa {
            cursor: pointer;
            text-align:center;
        }
        tr.shown td.details-control .fa {
            cursor: pointer;
            text-align:center;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <a class="navbar-brand" href="{{ route('dashboard.index') }}">
            Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav mr-auto">
                @hasanyrole('supervisor|administrator')

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->is('admin/*/winner') || request()->is('admin/winner')) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Winners
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item {{ request()->is('admin/winner') ? 'active' : '' }}" href="{{ route('winner.index') }}">
                                All
                            </a>
                            <div class="dropdown-divider"></div>

                            @foreach ($global_acties as $key => $menu_actie)

                                @if($menu_actie->active == true && $menu_actie->start_at <= date('Y-m-d') && $menu_actie->end_at >= date('Y-m-d'))

                                    <a class="dropdown-item {{ request()->is('admin/'.$menu_actie->id.'/winner') ? 'active' : '' }}" href="{{ route('winner.index_actie', [$menu_actie->id]) }}">
                                        {{ $menu_actie->name }}
                                    </a>

                                @endif

                            @endforeach

                            <div class="dropdown-divider"></div>

                            @foreach ($global_acties as $key => $menu_actie)

                                @if($menu_actie->active != true || $menu_actie->start_at > date('Y-m-d') || $menu_actie->end_at < date('Y-m-d'))

                                    <a class="dropdown-item {{ request()->is('admin/'.$menu_actie->id.'/winner') ? 'active' : '' }}" href="{{ route('winner.index_actie', [$menu_actie->id]) }}">
                                        {{ $menu_actie->name }}
                                    </a>

                                @endif

                            @endforeach

                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->is('admin/*/participant') || request()->is('admin/participant')) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-users fa-fw mr-1"></i> Participants
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item {{ request()->is('admin/participant') ? 'active' : '' }}" href="{{ route('participant.index') }}">
                                All
                            </a>
                            <div class="dropdown-divider"></div>

                            @foreach ($global_acties as $key => $menu_actie)

                                @if($menu_actie->active == true && $menu_actie->start_at <= date('Y-m-d') && $menu_actie->end_at >= date('Y-m-d'))

                                    <a class="dropdown-item {{ request()->is('admin/'.$menu_actie->id.'/participant') ? 'active' : '' }}" href="{{ route('participant.index_actie', [$menu_actie->id]) }}">
                                        {{ $menu_actie->name }}
                                    </a>

                                @endif

                            @endforeach

                            <div class="dropdown-divider"></div>

                            @foreach ($global_acties as $key => $menu_actie)

                                @if($menu_actie->active != true || $menu_actie->start_at > date('Y-m-d') || $menu_actie->end_at < date('Y-m-d'))

                                    <a class="dropdown-item {{ request()->is('admin/'.$menu_actie->id.'/participant') ? 'active' : '' }}" href="{{ route('participant.index_actie', [$menu_actie->id]) }}">
                                        {{ $menu_actie->name }}
                                    </a>

                                @endif

                            @endforeach

                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle {{ (request()->is('admin/*/voucher') || request()->is('admin/voucher')) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-gas-pump fa-fw mr-1"></i> Vouchers
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item {{ request()->is('admin/voucher') ? 'active' : '' }}" href="{{ route('voucher.index') }}">
                                All
                            </a>
                            <div class="dropdown-divider"></div>

                            @foreach ($global_acties as $key => $menu_actie)

                                @if($menu_actie->active == true && $menu_actie->start_at <= date('Y-m-d') && $menu_actie->end_at >= date('Y-m-d'))

                                    <a class="dropdown-item {{ request()->is('admin/'.$menu_actie->id.'/voucher') ? 'active' : '' }}" href="{{ route('voucher.index_actie', [$menu_actie->id]) }}">
                                        {{ $menu_actie->name }}
                                    </a>

                                @endif

                            @endforeach

                            <div class="dropdown-divider"></div>

                            @foreach ($global_acties as $key => $menu_actie)

                                @if($menu_actie->active != true || $menu_actie->start_at > date('Y-m-d') || $menu_actie->end_at < date('Y-m-d'))

                                    <a class="dropdown-item {{ request()->is('admin/'.$menu_actie->id.'/voucher') ? 'active' : '' }}" href="{{ route('voucher.index_actie', [$menu_actie->id]) }}">
                                        {{ $menu_actie->name }}
                                    </a>

                                @endif

                            @endforeach

                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('admin/coupon') ? 'active' : '' }}" href="{{ route('coupon.index') }}">
                            <i class="fas fa-award fa-fw mr-1"></i> Coupons
                        </a>
                    </li>

                @endhasanyrole
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif --}}
                @else
                    @hasanyrole('supervisor|administrator')
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('admin/download') ? 'active' : '' }}" href="{{ route('download.index') }}">
                                <i class="fas fa-download fa-fw mr-1"></i> Downloads
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->is('admin/maandprijs') ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-random fa-fw mr-1"></i> Monthprices
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ request()->is('admin/maandprijs') ? 'active' : '' }}" href="{{ route('maandprijs.index') }}">Overview</a>
                                <a class="dropdown-item {{ request()->is('admin/maandprijs/search') ? 'active' : '' }}" href="{{ route('maandprijs.search') }}">New winner</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ (request()->is('admin/*/setting') || request()->is('admin/setting')) ? 'active' : '' }}" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog fa-fw mr-1"></i> Settings
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                @foreach ($global_acties as $key => $menu_actie)

                                    @if($menu_actie->active == true && $menu_actie->start_at <= date('Y-m-d') && $menu_actie->end_at >= date('Y-m-d'))

                                        <a class="dropdown-item {{ request()->is('admin/'.$menu_actie->id.'/setting') ? 'active' : '' }}" href="{{ route('setting.index', [$menu_actie->id]) }}">
                                            {{ $menu_actie->name }}
                                        </a>

                                    @endif

                                @endforeach

                                <div class="dropdown-divider"></div>

                                @foreach ($global_acties as $key => $menu_actie)

                                    @if($menu_actie->active != true || $menu_actie->start_at > date('Y-m-d') || $menu_actie->end_at < date('Y-m-d'))

                                        <a class="dropdown-item {{ request()->is('admin/'.$menu_actie->id.'/setting') ? 'active' : '' }}" href="{{ route('setting.index', [$menu_actie->id]) }}">
                                            {{ $menu_actie->name }}
                                        </a>

                                    @endif

                                @endforeach

                            </div>
                        </li>
                    @endhasanyrole
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-user fa-fw mr-1"></i> {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>

        </div>
    </nav>

    @yield('content')

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>

    @yield('scripts')

</body>
</html>
