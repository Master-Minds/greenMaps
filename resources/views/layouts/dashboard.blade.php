<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/')  }}/node_modules/bootstrap/dist/css/bootstrap.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
<div id="app">
    <header class="header">
        <div class="shell clearfix">
            <a href="{{ url('/') }}" class="logo">
                <img src="{{ url('/') }}/images/logo-img.png">
                <h2>GreenMaps</h2>
            </a>

            <nav class="nav">
                <ul>
                    <li class="@php echo Request::segment(1) == '' ? 'current-menu-item' : '' @endphp">
                        <a href="{{ url('/') }}">Начало</a>
                    </li>
                    @if (!Auth::user())

                        <li class="@php echo (Request::segment(1) == 'register') ? 'current-menu-item' : '' @endphp">
                            <a href="{{ url('/register') }}">Регистрация</a>                            
                        </li>
                        <li class="log-in-link @php echo Request::segment(1) == 'login' ? 'current-menu-item' : '' @endphp">
                            <a href="{{ url('/login') }}"><img src="{{ url('/') }}/images/log-in.png">Вход</a>
                        </li>
                    @endif

                    @if(Auth::user())
                    <li class="@php echo Request::segment(1) == 'home' ? 'current-menu-item' : '' @endphp">
                        <a href="{{ url('/home') }}">Dashboard</a>
                    </li>
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form></li>
                    @endif
                </ul>
            </nav>
        </div>
    </header>
    @yield('content')
</div>
<script>
    var url = "{!! url('/') !!}";
</script>
@yield('scripts')
</body>
</html>