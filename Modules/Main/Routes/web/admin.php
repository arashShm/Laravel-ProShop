<?php 


Route::get('/modules' , [Modules\Main\Http\Controllers\Admin\MainController::class , 'index'])->name('main.index');

Route::patch('/modules/{module}/disable' , [Modules\Main\Http\Controllers\Admin\MainController::class , 'disable'])->name('main.disable');
Route::patch('/modules/{module}/enable' , [Modules\Main\Http\Controllers\Admin\MainController::class , 'enable'])->name('main.enable');