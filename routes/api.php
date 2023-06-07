<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CartController;
use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\JobPortalController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\ToDoController;
use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([

    'middleware' => 'api',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController:: class, 'login']);
    Route::post("register", [AuthController::class, "register"]);
    Route::get("me", [AuthController::class, "me"]);
    Route::post("logout", [AuthController::class, "logout"]);
    Route::post("refresh", [AuthController::class, "refresh"]);
    //cart
    Route::get("show-all-cart-food", [CartController::class, "show_all_cart_food"]);
    Route::post("add-to-cart", [CartController::class, "add_to_cart"]);
    Route::post("update-food-quantity-in-cart", [CartController::class, "update_food_quantity_in_cart"]);
    Route::delete("delete-cart", [CartController::class, "delete_cart"]);
    //students
    Route::get("all-students", [StudentController::class, "all_students"]);
    Route::post("add-student", [StudentController::class, "add_student"]);
    //Jobs
    Route::get("all-jobs", [JobPortalController::class, "all_jobs"]);
    Route::post("add-job", [JobPortalController::class, "add_job"]);
    Route::post("update-job", [JobPortalController::class, "update_job"]);
    Route::delete("delete-job", [JobPortalController::class, "delete_job"]);
    Route::get("all-countries", [JobPortalController::class, "all_countries"]);
    Route::get("country-wise-state", [JobPortalController::class, "country_wise_state"]);
    Route::get("state-wise-city", [JobPortalController::class, "state_wise_city"]);
    
});

//food api
Route::get("/food-category", [FoodController::class, "food_category"]);
Route::get("/newest-food", [FoodController::class, "newest_food"]);
Route::get("/all-products", [FoodController::class, "all_products"]);
Route::get("/food-detail", [FoodController::class, "food_detail"]);

//todo task api
Route::get("/get-task", [ToDoController::class, "get_task"]);
Route::post("add-employee", [ToDoController::class, "add_employee"]);