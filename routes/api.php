<?php

use App\Http\Controllers\Api\v1\ApiClientesController;
use App\Http\Controllers\Api\v1\ApiProdutosController;
use Illuminate\Support\Facades\Route;

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
Route::prefix("v1")->group(function () {
    /** Clientes */
    Route::prefix("clientes")->name("clientes.")->group(function () {
        Route::get("/", [ApiClientesController::class, "index"])->name("index");
        Route::get("/{id}", [ApiClientesController::class, "show"])->name("show");
        Route::post("/", [ApiClientesController::class, "store"])->name("store");
        Route::put("/{id}", [ApiClientesController::class, "update"])->name("update");
        Route::delete("/{id}", [ApiClientesController::class, "delete"])->name("delete");
    });

    /** Produtos */
    Route::prefix("produtos")->name("produtos.")->group(function () {
        Route::get("/", [ApiProdutosController::class, "index"])->name("index");
        Route::get("/{id}", [ApiProdutosController::class, "show"])->name("show");
        Route::post("/", [ApiProdutosController::class, "store"])->name("store");
    });
});
