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

Route::get('/', function () {
    return view('main');
});

Route::get('/playground', 'PlaygroundController@getView');

Auth::routes();

Route::get('/personal', 'PersonalController@index');


Route::group(['middleware' => 'web'], function (){
    Route::get('/accountImg/{avatar_url}', 'PersonalController@getAccountImg');

    Route::post('/modifyAccount', 'PersonalController@modifyAccount');

    Route::get('/toModifyAccount', 'PersonalController@toModifyAccount');

    Route::get('/resetPassword', 'PersonalController@resetPassword');

    Route::get('/toResetPassword', 'PersonalController@toResetPassword');

    Route::get('/toSinger/{singerId}', 'SingerController@singerDetail');

    Route::get('/getSongPic/{songPicUrl}', 'SingerController@getSongPic');

    Route::post('/postSongComment/{songId}', 'SongController@createComment');

    Route::post('/createNewSong/{singerId}/{singerName}', 'SongController@createSong');
    
    Route::get('/toAttachSong/{singer}', 'SongController@toAttachSong');
    
    Route::delete('/deleteSong/{songId}','SongController@deleteSong');

    Route::get('/toUpdateSong/{songId}/{singerId}','SongController@toUpdateSong');

    Route::put('/updateSong/{songId}/{singerId}','SongController@updateSong');
    
    Route::get('/getSingerPDF/{singerId}', 'SingerController@getSingerPDF');
    
    Route::get('/downloadSingerPDF/{singerId}', 'SingerController@downloadSingerPDF');

    Route::post('resetPassword', 'PersonalController@resetPassword');

    Route::resource('api/songs','SongResourceController', [
        'id' => 'songId'
    ]);

    Route::resource('api/singers','SingerResourceController', [
        'id' => 'singerId'
    ]);
});






