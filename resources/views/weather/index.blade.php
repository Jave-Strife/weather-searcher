@extends('layouts.app')

@section('content')
    @if( Auth::check() )
        <h1>{{ $prefecture->name }}{{ $location->name }}の天気</h1>

        <!-- 現在の天気 -->
        <div class="row">
            <h2 class="col-10">現在の天気</h2>
            <img class="col-2" src="http://openweathermap.org/img/wn/{{ $weather['current']['weather'][0]['icon'] }}@2x.png" alt="{{ $weather['current']['weather'][0]['main'] }}">
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>天候</th>
                        <th>気温(℃)</th>
                        <th>湿度(%)</th>
                        <th>気圧(hPa)</th>
                    </tr>
                </thead>
                <tr class="text-center">
                    <td>{{ $weather["current"]["weather"][0]["description"] }}</td>
                    <td>{{ $weather["current"]["temp"] }}</td>
                    <td>{{ $weather["current"]["humidity"] }}</td>
                    <td>{{ $weather["current"]["pressure"] }}</td>
                </tr>
            </table>
        </div>

        <!-- 3時間毎の天気 -->
        <div class="row">
            <h2 class="col-12">3時間毎の天気</h2>
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>時刻</th>
                        <th>天候</th>
                        <th>気温(℃)</th>
                        <th>湿度(%)</th>
                        <th>気圧(hPa)</th>
                    </tr>
                </thead>
                @foreach( $weather["hourly"] as $i => $value )
                    @if( $i > 0 && $i < 25 )
                        <tr class="text-center">
                            @if( $i % 3 == 0 )
                                <td>{{ date("H:i", $weather["hourly"][$i]["dt"] ) }}</td>
                                <td>
                                    {{ $weather["hourly"][$i]["weather"][0]["description"] }}
                                    <img class="col-2" src="http://openweathermap.org/img/wn/{{ $weather['hourly'][$i]['weather'][0]['icon'] }}@2x.png" alt="{{ $weather['hourly'][$i]['weather'][0]['main'] }}">
                                </td>
                                <td>{{ $weather["hourly"][$i]["temp"] }}</td>
                                <td>{{ $weather["hourly"][$i]["humidity"] }}</td>
                                <td>{{ $weather["hourly"][$i]["pressure"] }}</td>
                            @endif
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>

        <!-- 週間予報 -->
        <div class="row">
            <h2 class="col-12">週間予報</h2>
            <table class="table table-bordered table-sm">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>日付</th>
                        <th>天候</th>
                        <th>最高気温(℃)</th>
                        <th>最低気温(℃)</th>
                        <th>湿度(%)</th>
                        <th>気圧(hPa)</th>
                    </tr>
                </thead>
                @foreach( $weather["daily"] as $i => $value )
                    @if( $i > 0 && $i < 8 )
                        <tr class="text-center">
                            <td>{{ date("Y/m/d", $weather["daily"][$i]["dt"] ) }}</td>
                            <td>
                                {{ $weather["daily"][$i]["weather"][0]["description"] }}
                                <img class="col-2" src="http://openweathermap.org/img/wn/{{ $weather['daily'][$i]['weather'][0]['icon'] }}@2x.png" alt="{{ $weather['daily'][$i]['weather'][0]['main'] }}">
                            </td>
                            <td>{{ $weather["daily"][$i]["temp"]["max"] }}</td>
                            <td>{{ $weather["daily"][$i]["temp"]["min"] }}</td>
                            <td>{{ $weather["daily"][$i]["humidity"] }}</td>
                            <td>{{ $weather["daily"][$i]["pressure"] }}</td>
                        </tr>
                    @endif
                @endforeach
            </table>
        </div>

        <span class="small">&copy; <a href="https://openweathermap.org/">OpenWeatherMap</a></span>
    @endif
@endsection