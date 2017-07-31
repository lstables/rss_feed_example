<?php

/* Show Feed List */
Route::get('/', 'FeedController@index');

/* show actioned list */
Route::get('feed/actioned','FeedController@actioned');

/* delete feed item */
Route::any('feed/delete/{id}','FeedController@delete');

/* Action given feed item*/
Route::any('feed/action/{id}','FeedController@action');
