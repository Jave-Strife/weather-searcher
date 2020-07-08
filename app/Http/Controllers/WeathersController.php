<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Prefecture;
use App\City;
use GuzzleHttp\Client;

class WeathersController extends Controller
{
    public function index( $id ){
        // 市区町村IDを用いてcitiesテーブルを検索
        $location = City::find( $id );

        // citiesテーブルに存在しなかった場合はトップページにリダイレクトする
        if( $location === null ){
           return redirect('/');
        }

        // 市区町村IDを用いてprefecturesテーブルを検索
        $prefecture = Prefecture::find( $location->prefecture_id );

        # 検索結果のレコードから緯度経度を取得
        $lat = $location->lat;
        $lon = $location->lon;

        // 天気情報を取得する為のインスタンスを生成
        $weather = new Weather();

        // 天気情報をjson形式で取得
        $weather = $weather->getWeatherData( $lat, $lon );

        return view('weather.index', [
            'prefecture' => $prefecture,
            'location' => $location,
            'weather' => $weather,
        ]);
    }
}

class Weather{
    public function getWeatherData( $lat, $lon ){
        // URLを生成
        $owm_key = env('OWM_KEY');
        $base_url = 'https://api.openweathermap.org/data/2.5/onecall';
        $url = $base_url . "?appid={$owm_key}&lat={$lat}&lon={$lon}&lang=ja&units=metric";

        // 天気情報を取得
        $client = new Client();
        $response = $client->get( $url );

        // 天気情報をjson形式に変換
        $json = json_decode( $response->getBody(), true );

        /*
        // ローカルの天気情報を読み込む(テスト用)
        $file = '../test_weather_data.json';
        $json = file_get_contents( $file );
        $json = mb_convert_encoding( $json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
        $json = json_decode( $json, true );
        */

        return $json;
    }
}