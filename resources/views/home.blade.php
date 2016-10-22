@extends('layouts.app')

@section('content')
<div class="container">
    <div class="main-wrapper">
       <div ui-view class="view-animate"></div>
    </div>
</div>
    
@endsection

@section('scripts')
<script type="text/javascript" src="{{ url('/') }}/app/controllers/main-controller.js"></script>
<script type="text/javascript" src="{{ url('/') }}/app/controllers/about-controller.js"></script>
<script type="text/javascript" src="{{ url('/') }}/app/services/markers.js"></script>
@endsection
