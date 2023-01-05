@extends("layouts.master")

@section("contenu")
<p style="background-image: url('images/hotel.jpg');">
    <div class="row">
    <div class="col-12 p-4">
        <div class="jumbotron ">
                <h1 class="display-3">Bienvenu, <strong>{{userFullName()}} </strong></h1>
                <p class="lead">Nous somme ravis de vous revoir à Yanogo Hotel.</p>
                <hr class="my-4">
                <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Voir le Menu pour plus d'inforrmation</a>
                </p>
        </div>
    </div>
</div>
@endsection
{{--@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection--}}

