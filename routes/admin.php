<?php 
use Illuminate\Support\Facades\Route;
// Nhóm đường dẫn có tiền tố giống nhau
Route::prefix('admin')->group(function(){
    Route::get('product', function(){
        return "Category Page";
    });
    Route::get('user', function(){
        return "User Page";
    });
});
