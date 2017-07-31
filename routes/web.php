<?php


Route::get('/', function () {
    $rss = \App\Rss::paginate(10);
    return view('welcome',compact('rss'));
});
