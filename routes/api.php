<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProblemsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\BillDetailsController;
use App\Http\Controllers\SendDetailController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
    Route::get('/users', [AuthController::class, 'index']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/problems', [ProblemsController::class, 'index']);
    Route::get('/problems/finish', [ProblemsController::class, 'finish']);
    Route::get('/problems/search', [ProblemsController::class, 'search']);
    Route::get('/problems/{id}', [ProblemsController::class, 'show']);
    Route::post('/add-problem', [ProblemsController::class, 'store']);
    Route::get('/edit-problem/{id}', [ProblemsController::class, 'edit']);
    Route::put('/update-problem/{id}', [ProblemsController::class, 'update']);
    Route::delete('/delete-problem/{id}', [ProblemsController::class, 'destroy']);
});

//Send Email
Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/email', [HomeController::class, 'mail']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/customers', [CustomersController::class, 'index']);
    Route::post('/customer-create', [CustomersController::class, 'store']);
    Route::put('/customer-update/{id}', [CustomersController::class, 'update']);
    Route::get('/customers/{id}', [CustomersController::class, 'show']);
    Route::delete('/customer-delete', [CustomersController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/invoices', [InvoicesController::class, 'index']);
    Route::get('/invoices-branch', [InvoicesController::class, 'branch']);
    Route::get('/invoices/{id}', [InvoicesController::class, 'show']);
    Route::post('/invoices-create', [InvoicesController::class, 'store']);
    Route::get('/invoices-edit/{id}', [InvoicesController::class, 'edit']);
    Route::put('/invoices-update/{id}', [InvoicesController::class, 'update']);
    Route::delete('/invoices-delete/{id}', [InvoicesController::class, 'destroy']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/notifications', [NotificationsController::class, 'index']);
    Route::get('/notifications-code', [NotificationsController::class, 'codefilter']);
    Route::get('/notifications-day', [NotificationsController::class, 'dayfilter']);
    Route::get('/notifications-due-date', [NotificationsController::class, 'duedatefilter']);
    Route::get('/notifications-cusno', [NotificationsController::class, 'cusnofilter']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/branch', [BranchController::class, 'index']);
    Route::get('/branch/{id}', [BranchController::class, 'show']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/billdetails', [BillDetailsController::class, 'index']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::get('/details', [SendDetailController::class, 'index']);
    Route::post('/details-create', [SendDetailController::class, 'store']);
});




