<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SalaryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);
    Route::post('logout',  [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class,'refresh']);
    Route::post('me', [AuthController::class,'me']);

});

Route::controller(EmployeeController::class)->group(function(){
    Route::get('employee/all_employees', 'all');
    Route::post('employee/add_employee/', 'add');
    Route::get('employee/edit_employee/{id}', 'edit');
    Route::delete('employee/delete/{id}', 'delete');
    Route::patch('employee/update_employee/{id}', 'update');



});

Route::controller(SupplierController::class)->group(function(){
    Route::post('supplier/all_suppliers', 'get');
    Route::delete('supplier/delete/{id}', 'delete');
    Route::post('supplier/add_supplier/', 'add');
    Route::get('supplier/edit_supplier/{id}', 'edit');
    Route::patch('supplier/update_supplier/{id}', 'update');
    Route::get('supplier/get_suppliers', 'getCategory');


});

Route::controller(CategoryController::class)->group(function(){
    Route::get('category/all_categories', 'get');
    Route::delete('category/delete/{id}', 'delete');
    Route::post('category/add_category/', 'add');
    Route::get('category/edit_category/{id}', 'edit');
    Route::patch('category/update_category/{id}', 'update');

});

Route::controller(ProductController::class)->group(function(){
    Route::post('product/all_product', 'get');
    Route::post('product/add_product/', 'add');
    Route::delete('product/delete/{id}', 'delete');
    Route::get('product/edit_product/{id}', 'edit');
    Route::patch('product/update_product/{id}', 'update');




});

Route::controller(SalaryController::class)->group(function(){
    Route::post('salary/add_salary', 'add');
    Route::get('get_employee_salary/{id}', 'get_employee_salary');
    Route::get('salary/all_salary', 'get');
    Route::get('salary/edit_salary/{id}', 'edit');
    Route::patch('salary/update_salary/{id}', 'update');
    Route::delete('salary/delete/{id}', 'delete');





   



});