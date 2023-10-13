<?php

use App\Http\Controllers\API\CustomerAddressController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\PaymentMethodController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\TransactionDetailController;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::resource('customers', CustomerController::class);
Route::controller(CustomerController::class)
    ->prefix("/customers")
    ->name("customers.")
    ->group(function (){
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::put("/{id}", "update")->name("update");
        Route::delete("/{id}", "destroy")->name("destroy");
    });

    Route::controller(CustomerAddressController::class)
    ->prefix("/customer-address")
    ->name("customer-address.")
    ->group(function (){
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::put("/{id}", "update")->name("update");
        Route::delete("/{id}", "destroy")->name("destroy");
    });

    Route::controller(ProductController::class)
    ->prefix("/products")
    ->name("products.")
    ->group(function (){
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::put("/{id}", "update")->name("update");
        Route::delete("/{id}", "destroy")->name("destroy");
    });

    Route::controller(PaymentMethodController::class)
    ->prefix("/payment-method")
    ->name("payment-method.")
    ->group(function (){
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::put("/{id}", "update")->name("update");
        Route::delete("/{id}", "destroy")->name("destroy");
    });


    Route::controller(TransactionController::class)
    ->prefix("/transactions")
    ->name("transactions.")
    ->group(function (){
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::put("/{id}", "update")->name("update");
        Route::delete("/{id}", "destroy")->name("destroy");
    });

    Route::controller(TransactionDetailController::class)
    ->prefix("/transaction-detail")
    ->name("transaction-detail.")
    ->group(function (){
        Route::get("/", "index")->name("index");
        Route::post("/", "store")->name("store");
        Route::put("/{id}", "update")->name("update");
        Route::delete("/{id}", "destroy")->name("destroy");
    });
