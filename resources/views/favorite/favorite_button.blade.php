@if( Auth::user()->is_favoriting($city->id) )
    {!! Form::open(['route' => ['favorites.unfavorite', $city->id], 'method' => 'delete']) !!}
        {!! Form::submit('解除', ['class' => "btn btn-danger btn-sm"]) !!}
    {!! Form::close() !!}
@else
    {!! Form::open(['route' => ['favorites.favorite', $city->id]]) !!}
        {!! Form::submit('お気に入り', ['class' => "btn btn-warning btn-sm"]) !!}
    {!! Form::close() !!}
@endif