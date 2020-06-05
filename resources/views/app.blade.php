<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link rel="stylesheet" href="/css/main.css">
        <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    </head>
    <body class="bg-blue-100">
        <div id="app">
        <nav class="flex justify-between flex-wrap bg-gray-900 p-6">
        <div class="flex items-center text-white mr-6">
            <img src="https://img.icons8.com/color/48/000000/partly-cloudy-day.png"/>
            <router-link to="/" class="font-semibold text-xl tracking-tight ml-4">
            Cloudcast
            </router-link>
            </div>
        <div class="flex items-center text-white font-semibold">
        <router-link class="mr-4" to="/">Home</router-link>
        <router-link class="mr-4" to="/forecast">Forecast</router-link>
        <router-link class="mr-4" to="/posts">News</router-link>
        </div>
    </nav>
    <router-view></router-view>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/places.js@1.18.2"></script>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <script src="/js/app.js" defer></script>
    </body>
</html>
