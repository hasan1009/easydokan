<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;


Route::get('/',[AuthController::class,'login']);
Route::post('/',[AuthController::class,'auth_login']);
Route::get('logout',[AuthController::class,'logout']);


Route::group(['middleware'=>'admin'],function(){

     ///Dashboard
     Route::get('backend/dashboard',[DashboardController::class,'dashboard']); 

     ///Products
     Route::get('products/add',[ProductsController::class,'add']); 
     Route::post('products/add',[ProductsController::class,'insert']); 
     Route::get('products/list',[ProductsController::class,'list']); 
     Route::post('products/list/{id}',[ProductsController::class,'purchase']); 
     Route::get('products/edit/{id}',[ProductsController::class,'edit']); 
     Route::post('products/edit/{id}',[ProductsController::class,'update']);
     Route::delete('products/delete/{id}',[ProductsController::class,'delete']); 
     Route::get('products/print',[ProductsController::class,'print']);
  
     ///Supplier
     Route::get('supplier/add',[SupplierController::class,'add']);
     Route::post('supplier/add',[SupplierController::class,'insert']);
     Route::get('supplier/list',[SupplierController::class,'list']);
     Route::get('supplier/edit/{id}',[SupplierController::class,'edit']); 
     Route::post('supplier/edit/{id}',[SupplierController::class,'update']); 
     Route::delete('supplier/delete/{id}',[SupplierController::class,'delete']);
     Route::get('supplier/print',[SupplierController::class,'print']);

      ///Customer
      Route::get('customer/add',[CustomerController::class,'add']);
      Route::post('customer/add',[CustomerController::class,'insert']);
      Route::get('customer/list',[CustomerController::class,'list']);
      Route::get('customer/edit/{id}',[CustomerController::class,'edit']); 
      Route::post('customer/edit/{id}',[CustomerController::class,'update']); 
      Route::delete('customer/delete/{id}',[CustomerController::class,'delete']);
      Route::get('customer/print',[CustomerController::class,'print']);

});
