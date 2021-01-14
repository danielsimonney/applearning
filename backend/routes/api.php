<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register','AuthController@register');
Route::post('/login','AuthController@login');
Route::get('/user','AuthController@user');
Route::post('/logout','AuthController@logout');
Route::get('/tags','TopicController@tags');


Route::group(['prefix' => 'topics'],function(){
    Route::get('/{topic}/try','TopicController@test');
    Route::post('/','TopicController@store')->middleware('auth:api');
    Route::get('/','TopicController@index');
    Route::get('/{topic}','TopicController@show');
    Route::patch('/{topic}','TopicController@update')->middleware('auth:api');
    Route::delete('/{topic}','TopicController@destroy')->middleware('auth:api');
    // Post route groups
    Route::group(['prefix' => '/{topic}/posts'], function(){
        Route::post('/','PostController@store')->middleware('auth:api');
        Route::patch('/{post}','PostController@update')->middleware('auth:api');
        Route::delete('/{post}','PostController@destroy')->middleware('auth:api');
        Route::get('/{post}','PostController@show');
    });
});