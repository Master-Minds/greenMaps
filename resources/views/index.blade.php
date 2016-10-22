@extends('layouts.app')

@section('title')
    Green Maps
    @endsection

@section('content')
<div class="container" ng-controller="MainCtrl">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    Your Application's Landing Page.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ url('/')  }}/app/controllers/main-controller.js"></script>
    @endsection