<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\PaymentController;
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

Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('/product/details/{id}/{slug}',[FrontendController::class,'productdetails'])->name('productdetails');
Route::get('/category/products/{slug}',[FrontendController::class,'categoryProducts'])->name('categoryProducts');
Route::post('/category/products',[CartController::class,'addtocart'])->name('addtocart');
Route::get('/checkout',[FrontendController::class,'checkout'])->name('checkout');
Route::post('/cartproductqtyupdate/{id}',[FrontendController::class,'qtyUpdate'])->name('cartproductqtyupdate');
Route::get('/cartproductqtyupdate/{id}',[FrontendController::class,'qtyDelete'])->name('productdeleteformcart');
Route::post('/confirmorder',[FrontendController::class,'confirmorder'])->name('confirmorder');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function (){
    Route::get('/admin/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/invoice/{id}',[AdminController::class,'invoice'])->name('invoice');

// Caregory Route List
    Route::get('/admin/add',[CategoryController::class,'categoryAddForm'])->name('category.add');
    Route::get('/admin/manage',[CategoryController::class,'categoryManage'])->name('category.manage');
    Route::post('/admin/store',[CategoryController::class,'categorystore'])->name('category.store');
    Route::get('/admin/category/edit/{id}',[CategoryController::class,'categoryedit'])->name('category.edit');
    Route::post('/admin/category/update/{id}',[CategoryController::class,'categoryupdate'])->name('category.update');
    Route::get('/admin/category/delete/{id}',[CategoryController::class,'categorydelete'])->name('category.delete');


    //Sub-Caregory Route List
    Route::get('/subcategory/add',[SubCategoryController::class,'subcategoryAddForm'])->name('subcategory.add');
    Route::get('/subcategory/manage',[SubCategoryController::class,'subcategoryManage'])->name('subcategory.manage');
    Route::post('/admin/substore',[SubCategoryController::class,'subcategorystore'])->name('subcategory.store');
    Route::get('/admin/subcategory/edit/{id}',[SubCategoryController::class,'subcategoryedit'])->name('subcategory.edit');
    Route::post('/admin/subcategory/update/{id}',[SubCategoryController::class,'subcategoryupdate'])->name('subcategory.update');
    Route::get('/admin/subcategory/delete/{id}',[SubCategoryController::class,'subcategorydelete'])->name('subcategory.delete');


    // Product Route List
    Route::get('/admin/product/add',[ProductController::class,'productAddForm'])->name('product.add');
    Route::get('/admin/product/manage',[ProductController::class,'productManage'])->name('product.manage');
    Route::post('/admin/product/manage',[ProductController::class,'productStore'])->name('product.store');
    Route::get('/admin/product/edit/{id}',[ProductController::class,'productEdit'])->name('product.edit');
    Route::post('/admin/product/update/{id}',[ProductController::class,'productUpdate'])->name('product.update');
    Route::get('/admin/product/delete/{id}',[ProductController::class,'productDelete'])->name('product.delete');
});


Route::post('/payment', [PaymentController::class,'payment'])->name('payment');

Route::post('/success', [PaymentController::class,'success'])->name('success');
Route::post('/fail', [PaymentController::class,'fail'])->name('fail');
Route::post('/cancel', [PaymentController::class,'cancel'])->name('cancel');
