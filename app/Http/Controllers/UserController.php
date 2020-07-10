<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\City;

class UserController extends Controller
{
    public function show( $id ){
        $user = User::find( $id );

        // citiesテーブルの要素数を取得
        $count_cities = count( City::all() );

        // 表示上限を要素数分までにする
        $favorites = $user->favorites()->paginate( $count_cities );

        return view('user.show', [
            'user' => $user,
            'favorites' => $favorites,
        ]);
    }
}
