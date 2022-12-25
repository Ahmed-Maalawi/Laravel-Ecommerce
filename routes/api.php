<?php

use App\Http\Controllers\Category\SubCategoryController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserAuthController;
use App\Http\Controllers\Brand\BrandController;
use Illuminate\Support\Facades\Route;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

/**
|--------------------------------------------------------------------------
| API Routes For Admin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function (){
    Route::controller(AdminAuthController::class)->group(function (){
        Route::post('login', 'login')->name('admin.login');
        Route::get('logout', 'logout')->name('admin.logout');
        Route::get('me', 'me')->name('admin.me');
        Route::put('refresh', 'refresh')->name('admin.refresh');
    });
});



/**
|--------------------------------------------------------------------------
| API Routes For User
|--------------------------------------------------------------------------
 */
Route::prefix('auth')->group(function (){
    Route::controller(UserAuthController::class)->group(function (){
        Route::post('login', 'login')->name('user.login');
        Route::post('register', 'register')->name('user.register');
        Route::get('logout', 'logout')->name('user.logout');
        Route::get('me', 'me')->name('user.me');
        Route::put('refresh', 'refresh')->name('user.refresh');
    });
});


/**
|--------------------------------------------------------------------------
| API Routes For Brand
|--------------------------------------------------------------------------
 */
Route::prefix('brand')->group(function (){
    Route::controller(BrandController::class)->group(function (){
        Route::get('all', 'index')->name('brand.all');
        Route::post('add', 'store')->name('brand.add');
        Route::get('get/{id}', 'show')->name('brand.get');
        Route::post('update/{id}', 'update')->name('brand.update');
        Route::delete('delete/{id}', 'destroy')->name('brand.delete');
    });
});



/**
|--------------------------------------------------------------------------
| API Routes For Category
|--------------------------------------------------------------------------
 */
Route::prefix('category')->group(function (){
    Route::controller(CategoryController::class)->group(function (){
        Route::get('all', 'index')->name('category.all');
        Route::post('add', 'store')->name('category.add');
        Route::get('get/{id}', 'show')->name('category.get');
        Route::post('update/{id}', 'update')->name('category.update');
        Route::delete('delete/{id}', 'destroy')->name('category.delete');
    });
});


/**
|--------------------------------------------------------------------------
| API Routes For SubCategory
|--------------------------------------------------------------------------
 */
Route::prefix('subcategory')->group(function (){
    Route::controller(SubCategoryController::class)->group(function (){
        Route::get('all', 'index')->name('subcategory.all');
        Route::post('add', 'store')->name('subcategory.add');
        Route::get('get/{id}', 'show')->name('subcategory.get');
        Route::post('update/{id}', 'update')->name('subcategory.update');
        Route::delete('delete/{id}', 'destroy')->name('subcategory.delete');
    });
});



/**
|--------------------------------------------------------------------------
| API Routes For Product
|--------------------------------------------------------------------------
 */
Route::prefix('product')->group(function (){
    Route::controller(ProductController::class)->group(function (){
        Route::get('all', 'index')->name('product.all');
        Route::post('add', 'store')->name('product.add');
        Route::get('get/{id}', 'show')->name('product.get');
        Route::post('update/{id}', 'update')->name('product.update');
        Route::delete('delete/{id}', 'destroy')->name('product.delete');
    });
});
