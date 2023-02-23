<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MainController;
use App\Models\Post;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::prefix('v1')->group(function () {
    //Main
    Route::get('/governorates', [MainController::class, 'governorates']);
    Route::get('/cities', [MainController::class, 'cities']);
    Route::get('/categories', [MainController::class, 'categories']);
    Route::get('/blood-types', [MainController::class, 'bloodTypes']);

###########################
    //Auth
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/send-pin-code', [AuthController::class, 'sendPinCode']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);



    Route::middleware(['auth:api'])->group(function () {
        //posts
        Route::get('/posts', [MainController::class, 'posts']);
        Route::get('/post-details', [MainController::class, 'postDetails']);
        Route::get('/post-search', [MainController::class, 'search']);
        Route::post('/post-favorites', [MainController::class, 'postFavorites']);
        Route::get('/my-favorites', [MainController::class, 'myFavorites']);

        //profile
        Route::post('/profile', [AuthController::class, 'profile']);

        //settings
        Route::post('/notification-settings', [AuthController::class, 'notificationSettings']);

        //contact
        Route::post('/contact', [AuthController::class, 'contact']);

        //tokens
        Route::post('/register-token', [AuthController::class, 'registerToken']);
        Route::post('/remove-token', [AuthController::class, 'removeToken']);

        //Donation Request
        Route::post('/donation-request-create', [MainController::class, 'donationRequestCreate']);

    });
});


