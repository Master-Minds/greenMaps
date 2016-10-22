<!DOCTYPE html>
<html lang="en" ng-app="GreenMaps">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
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
                <a href="#" class="logo">
                   <!--  <img src="{{ url('/') }}/images/logo.png"> -->
                   <h2>GreenMaps</h2>
                </a>

               <nav class="nav">
                   <ul>
                       <li>
                           <a href="#">Начало</a>
                       </li>
                       <li>
                           <a href="#">Добави контейнер</a>
                       </li>
                   </ul>
               </nav>
            </div>
       </header>
        @yield('content')
    </div>
    <!-- Core JavaScripts -->
    <script src="{{ url('/') }}/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('/')  }}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ url('/')  }}/node_modules/angular/angular.min.js"></script>
    <script src="{{ url('/')  }}/app/app.js"></script>
    @yield('scripts')
</body>
</html>
