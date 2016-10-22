@extends('layouts.app')

@section('content')
    <div ui-view class="view-animate"></div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ url('/') }}/app/controllers/main-controller.js"></script>
<script type="text/javascript" src="{{ url('/') }}/app/controllers/about-controller.js"></script>
@endsection
