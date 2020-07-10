@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    <img class="rounded img-fluid" src="{{ Gravatar::src($user->email, 500) }}" alt="">
                </div>
            </div>
        </aside>
        <div class="col-sm-8">
            @if( count( $favorites ) === 0 )
                <p>お気に入りの市区町村はありません</p>
            @else
                <p>お気に入り一覧</p>
                <table class="table table-bordered">
                    @foreach( $favorites as $favorite )
                        <td>
                            {!! link_to_route('weather.show', $favorite->name, ['prefecture_id' => $favorite->id] ) !!}
                            @if( Auth::user()->is_favoriting($favorite->id) )
                                {!! Form::open(['route' => ['favorites.unfavorite', $favorite->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('解除', ['class' => "btn btn-danger btn-sm"]) !!}
                                {!! Form::close() !!}
                            @else
                                {!! Form::open(['route' => ['favorites.favorite', $favorite->id]]) !!}
                                    {!! Form::submit('お気に入り', ['class' => "btn btn-warning btn-sm"]) !!}
                                {!! Form::close() !!}
                            @endif
                        </td>
                    @endforeach
                </table>
            @endif
        </div>
    </div>
@endsection