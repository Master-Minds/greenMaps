@extends('layouts.app')

@section('content')
    <div ui-view class="view-animate"></div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ url('/') }}/app/controllers/main-controller.js"></script>
@endsection
