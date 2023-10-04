<?php

use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Gate;
use App\Models\ActiveCode ;
use App\Notifications\LoginToSiteNotification;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [App\Http\Controllers\IndexController::class , 'index']);
    // return \Carbon\Carbon::now()->subDay(2);
    // return route('download.file' , ['user' => auth()->user()->id , 'path' => '/files/111.jpg']);

    // return URL::temporarySignedRoute('download.file',now()->addMinutes(1),['user'=>auth()->user()->id,'path' =>'/files/111.jpg']);




Route::get('/download/{user}/file' , function($file){




    return Storage::download(request('path')) ;

})->name('download.file')->middleware('signed');

Auth::routes(['verify' => true]);

//Google Login routes
Route::get('/auth/google' , [App\Http\Controllers\Auth\GoogleAuthController::class , 'redirect'])->name('auth.google');
Route::get('/auth/google/callback' , [App\Http\Controllers\Auth\GoogleAuthController::class , 'callback']);
Route::get('/auth/twofactor' , [App\Http\Controllers\Auth\AuthTwoFactorController::class , 'getToken'])->name('auth.factor.form');
Route::post('/auth/twofactor' , [App\Http\Controllers\Auth\AuthTwoFactorController::class , 'postToken'])->name('auth.factor.post');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');

Route::get('/secret', function(){
    return "secret";
})->middleware(['auth' , 'password.confirm:password.confirm']);


Route::middleware('auth')->group(function(){
    Route::prefix('profile')->group(function(){
        Route::get('/' , [App\Http\Controllers\Profile\IndexController::class , 'index'])->name('profile.index');
        Route::get('twofactor' , [App\Http\Controllers\Profile\TwoFactorAuthController::class , 'twoFactor'])->name('profile.factor');
        Route::post('twofactor' , [App\Http\Controllers\Profile\TwoFactorAuthController::class , 'manageTwoFactor'])->name('profile.factor.update');
    
        Route::get('twofactor/confirmation' , [App\Http\Controllers\Profile\TokenAuthController::class , 'getPhoneVerify'])->name('profile.factor.phone') ;
        Route::post('twofactor/confirmation' , [App\Http\Controllers\Profile\TokenAuthController::class , 'postPhoneVerify'])->name('profile.factor.insertCode') ;

        Route::get('orders'  , [App\Http\Controllers\Profile\OrderController::class , 'index'])->name('profile.orders');
        Route::get('orders/{order}'  , [App\Http\Controllers\Profile\OrderController::class , 'showDetails'])->name('profile.orders.detail');
        Route::get('orders/{order}/payment'  , [App\Http\Controllers\Profile\OrderController::class , 'payment'])->name('profile.orders.payment');
    });


    Route::post('comments' , [App\Http\Controllers\HomeController::class , 'comments'])->name('send.comment');
    Route::post('payment' , [App\Http\Controllers\PaymentController::class , 'payment'])->name('cart.payment');
    Route::get('payment/callback' , [App\Http\Controllers\PaymentController::class , 'callback'])->name('payment.callback');
});




Route::get('products' , [App\Http\Controllers\ProductController::class , 'index']) ;
Route::get('products/{product}' , [App\Http\Controllers\ProductController::class , 'single'])->name('product.single') ;


