@extends('layouts.app')

@section('content')
    @if( Auth::check() )
        <!--  {{ Auth::user()->name }} -->
        <p>天気が見たい都道府県の市区町村を選んで下さい。</p>
        <div class="accordion" id="prefectures">
            @foreach( $prefectures as $prefecture )
                <div class="card">
                    <div class="card-header" id="heading{{ $prefecture->id }}">
                        <button class="btn btn-link btn-block text-dark" type="button" data-toggle="collapse" data-target="#collapse{{ $prefecture->id }}" aria-expanded="true" aria-controls="collapse{{ $prefecture->id }}">
                            {{ $prefecture->name }}
                        </button>
                    </div>
                    <div id="collapse{{ $prefecture->id }}" class="collapse" aria-labelledby="heading{{ $prefecture->id }}" data-parent="#prefectures">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" style="table-layout: fixed;">
                                    @foreach( $cities as $city )
                                        @if( $city->prefecture_id == $prefecture->id )
                                            <td style="width: 120px;">
                                                {!! link_to_route('weather.show', $city->name, ['prefecture_id' => $city->id] ) !!}
                                                @include('favorite.favorite_button')
                                            </td>
                                        @endif
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <p></p>
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