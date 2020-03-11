@extends('layouts.app')
@section('header')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
 
                    <div id="app-vue">
                        <app></app>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
