<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth ;
use App\Http\Controllers\Admin\UserController ;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductGalleryController;

Route::get('/' , function(){
    $user = auth()->loginUsingId(1);
    // return $user ;
    return view('admin.index') ;
})->name('main') ;

Route::resource('users' , UserController::class) ;
Route::get('/users/{user}/permissions' , [App\Http\Controllers\Admin\PermissionController::class , 'setPermissionCreate'])->name('users.permission.create');
Route::post('/users/{user}/permissions' , [App\Http\Controllers\Admin\PermissionController::class , 'setPermissionStore'])->name('users.permission.store');

Route::resource('permissions' , PermissionController::class) ;

Route::resource('roles' , RoleController::class) ;

Route::resource('products' , ProductController::class)->except(['show']);
Route::resource('product.gallery' , ProductGalleryController::class);

Route::resource('orders' , OrderController::class);
Route::get('orders/{order}/orders' , [App\Http\Controllers\Admin\OrderController::class , 'payment'])->name('orders.payments') ;

Route::resource('comments' , CommentController::class)->only(['index' , 'update' , 'destroy']);
Route::get('comments/unapproved' , [App\Http\Controllers\Admin\CommentController::class , 'unapproved'])->name('comments.unapproved');

Route::resource('categories' , CategoryController::class);

Route::post('attribute/values' , [App\Http\controllers\Admin\AttributeController::class , 'getValues']);