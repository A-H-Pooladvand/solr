<?php

Route::get('/', 'Main\Admin\MainController@index')->name('index');
Route::get('solr', 'Solr\Admin\SolrController@index')->name('index');
