<?php declare(strict_types=1);

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => ['mergeParameters']], static function () {
    Route::post('categories', ['as' => 'create-category', 'uses' => 'CategoryApiController@createCategory']);
    Route::get('categories/{categoryId}', ['as' => 'get-category', 'uses' => 'CategoryApiController@getCategory']);
    Route::get('categories/{categoryId}/ancestors', ['as' => 'get-category-ancestors', 'uses' => 'CategoryApiController@getAncestors']);
    Route::put('categories/{categoryId}', ['as' => 'update-category', 'uses' => 'CategoryApiController@updateCategory']);
    Route::get('categories', ['as' => 'get-category-list', 'uses' => 'CategoryApiController@getCategoryList']);
    Route::delete('categories/{categoryId}', ['as' => 'delete-category', 'uses' => 'CategoryApiController@deleteCategory']);

    Route::post('products', ['as' => 'create-product', 'uses' => 'ProductApiController@createProduct']);
    Route::get('categories/{categoryId}/products', ['as' => 'get-product-by-category', 'uses' => 'ProductApiController@getProductsByCategoryId']);
    Route::put('products/{productId}', ['as' => 'update-product', 'uses' => 'ProductApiController@updateProduct']);
    Route::delete('products/{productId}', ['as' => 'delete-product', 'uses' => 'ProductApiController@deleteProduct']);
    Route::post('products/{productId}/move', ['as' => 'move-product', 'uses' => 'ProductApiController@moveProduct']);
    Route::post('products/{productId}/add-photo', ['as' => 'add-product-photo', 'uses' => 'ProductApiController@addProductPhoto']);

    Route::post('photos', ['as' => 'create-photo', 'uses' => 'PhotoApiController@createPhoto']);
    Route::delete('photos/{photoId}', ['as' => 'delete-photo', 'uses' => 'PhotoApiController@deletePhoto']);
    Route::post('photos/{photoId}', ['as' => 'update-photo', 'uses' => 'PhotoApiController@updatePhoto']);

    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
});
