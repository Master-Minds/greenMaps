@extends('layouts.app')

@section('content')
<div class="container" ng-controller="MainCtrl">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{ url('/') }}/app/controllers/main-controller.js"></script>
@endsection
