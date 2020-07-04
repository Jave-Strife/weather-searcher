@extends('layouts.app')

@section('content')
    @if( Auth::check() )
        {{ Auth::user()->name }}
    @else
        <div class="center jumbotron">
            <div class="text-center">
                <h1>Weather Searcherへようこそ！</h1>
                {!! link_to_route('signup.get', 'Signup', [], ['class' => 'btn btn-lg btn-primary']) !!}
                {!! link_to_route('login.post', 'Login', [], ['class' => 'btn btn-lg btn-primary']) !!}
            </div>
        </div>
    @endif
@endsection