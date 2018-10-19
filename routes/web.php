<?php

Route::get('/', 'Main\Admin\MainController@index')->name('index');
Route::get('solr', 'Solr\Admin\SolrController@index')->name('index');

Route::group(['prefix' => 'index', 'as' => 'index.', 'namespace' => 'Index\Admin'], function () {
    Route::post('/', 'IndexController@store')->name('store');
    Route::put('/', 'IndexController@destroy')->name('destroy');
    Route::post('truncate', 'IndexController@truncate')->name('truncate');
    Route::post('seed', 'IndexController@seed')->name('seed');
    Route::post('fields', 'IndexController@fields')->name('fields');
});