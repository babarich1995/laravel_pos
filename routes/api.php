<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthController;
use \App\Http\Controllers\EmployeeController;
use \App\Http\Controllers\SupplierController;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\ExpenseController;
use \App\Http\Controllers\SalaryController;
use \App\Http\Controllers\CustomerController;
use \App\Http\Controllers\PosController;
use \App\Http\Controllers\CartController;
use \App\Http\Controllers\OrderController;
use \App\Http\Controllers\AllowanceController;
use \App\Http\Controllers\DeductionController;






Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);

});

Route::apiResource('/employee', EmployeeController::class);
Route::apiResource('/supplier', SupplierController::class);
Route::apiResource('/category', CategoryController::class);
Route::apiResource('/product', ProductController::class);
Route::apiResource('/expense', ExpenseController::class);
Route::apiResource('/customer', CustomerController::class);
Route::apiResource('/allowance', AllowanceController::class);
Route::apiResource('/deduction', DeductionController::class);

Route::post('/salary/paid/{id}',  [SalaryController::class,'Paid']);
Route::get('/salary',  [SalaryController::class,'Salary']);
Route::get('/payroll',  [SalaryController::class,'Payroll']);
Route::get('/salary/view/{id}',  [SalaryController::class,'ViewSalary']);
Route::get('/edit/salary/{id}',  [SalaryController::class,'EditSalary']);
Route::post('/salary/update/{id}',  [SalaryController::class,'UpdateSalary']);
Route::get('/allowances/view/{id}',  [AllowanceController::class,'ViewAllowance']);
Route::get('/user_allowance',  [AllowanceController::class,'UserAllowance']);
Route::get('/userallowance/delete/{id}',  [AllowanceController::class,'DeleteMember']);
Route::post('/allowance/member/{id}',  [AllowanceController::class,'AddMember']);
Route::get('/deductions/view/{id}',  [DeductionController::class,'ViewDeduction']);
Route::post('/deductions/member/{id}',  [DeductionController::class,'AddMember']);
Route::get('/delete/member/{id}',  [DeductionController::class,'DeleteMember']);

Route::post('/stock/update/{id}',  [ProductController::class,'UpdateStock']);




Route::get('/fetch/product/{id}',  [PosController::class,'FetchProduct']);
Route::post('/orderdone',  [PosController::class,'OrderDone']);
Route::post('/search/order',  [PosController::class,'SearchOrderDate']);
Route::get('/today/sale',  [PosController::class,'TodaySale']);
Route::get('/today/income',  [PosController::class,'TodayIncome']);
Route::get('/today/due',  [PosController::class,'TodayDue']);
Route::get('/today/expense',  [PosController::class,'TodayExpense']);
Route::get('/today/stockout',  [PosController::class,'StockOut']);

Route::get('/orders',  [OrderController::class,'TodayOrder']);
Route::get('/order/details/{id}',  [OrderController::class,'OrderDetails']);
Route::get('/order/orderdetails/{id}',  [OrderController::class,'OrderDetailsAll']);



Route::get('/addToCart/{id}',  [CartController::class,'AddToCart']);
Route::get('/cart/product',  [CartController::class,'CartProduct']);
Route::get('/remove/cart/{id}',  [CartController::class,'RemoveCart']);
Route::get('/increment/{id}',  [CartController::class,'IncrementCart']);
Route::get('/decrement/{id}',  [CartController::class,'DecrementCart']);

Route::get('/vats',  [CartController::class,'Vats']);