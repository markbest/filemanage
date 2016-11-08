<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::group(['middleware' => ['auth']], function()
{
    Route::get('/', 'PicturesController@index');

    Route::resource('albums', 'AlbumsController');

    Route::resource('pictures', 'PicturesController');
    Route::post('pictures/upload', 'PicturesController@upload');
    Route::post('pictures/move', 'PicturesController@move');
    Route::post('pictures/delete', 'PicturesController@delete');
    Route::get('pictures/download/{id}', 'PicturesController@download');

    Route::resource('folders', 'FoldersController');
    Route::get('folders/delete/{id}', 'FoldersController@delete');

    Route::resource('files', 'FilesController');
    Route::post('files/upload', 'FilesController@upload');
    Route::post('files/move', 'FilesController@move');
    Route::post('files/delete', 'FilesController@delete');
    Route::get('files/folder/{id}', 'FilesController@folder');
    Route::get('files/download/{id}', 'FilesController@download');
});

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Http\Controllers\Api\V1'], function ($api){

        /* 登录api获取token */
        $api->post('authenticate', 'AuthenticateController@authenticate');

        /* 通过token获取客户信息 */
        $api->get('getUser', 'AuthenticateController@authenticatedUser');

        /* 销毁token，如果需要继续使用API则需要重新登录 */
        $api->get('logout', 'AuthenticateController@logout');

        /* 重新生成token */
        $api->get('token', 'AuthenticateController@getToken');
    });

    $api->group(['namespace' => 'App\Http\Controllers\Api\V1', 'middleware' => ['jwt.auth']], function ($api){
        $api->resource('album', 'AlbumsController');
        $api->resource('picture', 'PicturesController');
        $api->resource('folder', 'FoldersController');
        $api->resource('file', 'FilesController');
    });
});
