<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



//header("Access-Control-Allow-Origin: *");
//header('Access-Control-Allow-Methods: POST,GET,PUT,DELETE,PATCH,OPTIONS');
//header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

Route::post('addUser', 'App\Http\Controllers\LoginController@resgisterUser')->middleware('cors');
Route::post('userLogin', 'App\Http\Controllers\LoginController@verifyUserLogin')->middleware('cors'); //Login
Route::post('logoutUser', 'App\Http\Controllers\LoginController@logoutUser')->middleware('cors'); //Logout
Route::get('viewUser', 'App\Http\Controllers\LoginController@viewUser')->middleware('cors'); //View user
Route::post('addExpense', 'App\Http\Controllers\ExpenseController@addExpense')->middleware('cors'); //Add expense
Route::get('getCategories', 'App\Http\Controllers\ExpenseController@getCategories')->middleware('cors'); //Get expense category list
Route::get('getExpenseList', 'App\Http\Controllers\ExpenseController@getUserExpenseList')->middleware('cors'); //Add expense list
Route::get('test', 'App\Http\Controllers\LoginController@test')->middleware('cors');
