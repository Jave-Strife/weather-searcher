@extends('layouts.app')

@section('content')
    @include('user.user', ['user' => $user])
@endsection