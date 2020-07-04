@extends('layouts.app')

@section('content')
    <div class="center jumbotron">
        <div class="text-center">
            <h1>Weather Searcherへようこそ！</h1>
            {!! link_to_route('signup.get', 'Signup', [], ['class' => 'btn btn-lg btn-primary']) !!}
            {!! link_to_route('signup.get', 'Login', [], ['class' => 'btn btn-lg btn-primary']) !!}
        </div>
    </div>
@endsection