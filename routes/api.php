<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Post;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/weather', function () {
    $apiKey = config('services.openweathermap.key');
    $lat = request('lat');
    $lng = request('lng');
    $response = Http::get('api.openweathermap.org/data/2.5/weather?lat=' . $lat . '&lon=' . $lng . '&appid=' . $apiKey . '&units=metric');
    return $response->json();
});

Route::get('/forecast', function () {
    $apiKey = config('services.openweathermap.key');
    $lat = request('lat');
    $lng = request('lng');
    $response = Http::get('api.openweathermap.org/data/2.5/onecall?lat=' . $lat . '&lon=' . $lng . '&exclude=current,hourly' . '&appid=' . $apiKey . '&units=metric');
    return $response->json();
});

Route::get('/posts', function () {
    $posts = Post::paginate(5);
    return response()->json($posts);
});
