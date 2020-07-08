<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Prefecture;
use App\City;

class CitiesController extends Controller
{
    public function index(){
        $prefectures = Prefecture::all();
        $cities = City::all();

        return view('cities.index', [
            'prefectures' => $prefectures,
            'cities' => $cities,
        ]);
    }
}