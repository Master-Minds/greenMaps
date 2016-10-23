@extends('layouts.dashboard')

@section('content')
<div class="main-wrapper" ng-app="DashboardGreenApp">

   <div ui-view class="view-animate"></div>
</div>
    
@endsection
<!-- Core JavaScripts -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYVoPPn46EivzxaA1nHfAI4z3t8b-1iDs"></script>
<script src="{{ url('/')  }}/node_modules/moment/min/moment.min.js"></script>
<script src="{{ url('/')  }}/node_modules/jquery/dist/jquery.min.js"></script>
<script src="{{ url('/')  }}/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="{{ url('/')  }}/node_modules/angular/angular.min.js"></script>
<script src="{{ url('/')  }}/node_modules/angular-ui-router/release/angular-ui-router.min.js"></script>

<script src="{{ url('/')  }}/app/dashboard-app.js"></script>
<script src="{{ url('/')  }}/app/controllers/dashboard-ctrl.js"></script>
@section('scripts')
<!-- <script type="text/javascript" src="{{ url('/') }}/app/controllers/main-controller.js"></script>
<script type="text/javascript" src="{{ url('/') }}/app/controllers/about-controller.js"></script>
<script type="text/javascript" src="{{ url('/') }}/app/services/markers.js"></script> -->
@endsection
