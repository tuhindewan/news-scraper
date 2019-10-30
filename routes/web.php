<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index');
Route::get('/article-details/{id}', 'HomeController@getArticleDetails');
Route::get('/category/{id}', 'HomeController@getCategory');

Route::prefix('dashboard')->group(function () {
    Route::resource('/categories', 'CategoriesController');
    Route::resource('/websites', 'WebsitesController');
    Route::resource('/item-schema', 'ItemSchemaController');
    Route::resource('/links', 'LinksController');
    Route::patch('/links/set-item-schema', 'LinksController@setItemSchema');
    Route::get('/links/{link}/scrape', 'LinksController@scrape');
    Route::get('/articles', 'HomeController@index');
});
