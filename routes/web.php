<?php
//Admin-Dashboard Controllers
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DonationController;
use App\Http\Controllers\Admin\GovernorateController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\UserController;
//Web-Front Controllers
use App\Http\Controllers\Front\AuthController;
use App\Http\Controllers\Front\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/login', function () {
    return view('auth.login');
})->name('admin.login');

Auth::routes(['register' => false]);

//Admin-Dashboard
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    //profile
    Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/change-password', [App\Http\Controllers\Admin\ProfileController::class, 'changePassword'])->name('profile.change.password');
    Route::post('/profile/password-save', [App\Http\Controllers\Admin\ProfileController::class, 'passwordSave'])->name('profile.password.save');

    Route::group(['middleware' => ['role:super-admin|admin|editor']], function () {
        //Governorates
        Route::resource('/governorates', GovernorateController::class);
        //Cities
        Route::resource('/cities', CityController::class);
        //Categories
        Route::resource('/categories', CategoryController::class);
        //posts
        Route::resource('/posts', PostController::class);
        //settings
        Route::resource('/settings',SettingsController::class)->only('index','update');
    });
    Route::group(['middleware' => ['role:super-admin|admin']], function () {
        //clients
        Route::resource('/clients', ClientController::class)->except('create' , 'edit' , 'update');
        //client De-Active and Active
        Route::post('client/de-active/{id}', [ClientController::class, 'deActive'])->name('client.DeActive');
        Route::post('client/active/{id}', [ClientController::class, 'active'])->name('client.active');
        //contacts
        Route::resource('/contacts',ContactController::class)->only('index' , 'destroy');
        //donations
        Route::resource('/donations',DonationController::class)->only('index' , 'destroy' ,'show');
    });
    Route::group(['middleware' => ['role:super-admin','permission:mange-site']], function () {
        //roles
        Route::resource('/roles', RoleController::class);
        //permissions
        Route::resource('/permissions', PermissionController::class);
        //users
        Route::resource('/users', UserController::class);
    });
});

//Web-Front
Route::get('/home', [MainController::class, 'index'])->name('home');
Route::get('/who-we-are', [MainController::class, 'whoWeAre'])->name('who_we_are');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/contact-us', [MainController::class, 'contactUs'])->name('contact.us');
Route::get('/posts', [MainController::class, 'posts'])->name('posts');
Route::get('/post/details/{id}', [MainController::class, 'postDetails'])->name('post.details');


Route::get('/client/register', [AuthController::class, 'showRegisterForm'])->name('client.get.register');
Route::post('/client/register', [AuthController::class, 'register'])->name('client.register');

Route::get('/client/login', [AuthController::class, 'showLoginForm'])->name('client.get.login');
Route::post('/client/login-check', [AuthController::class, 'login'])->name('client.login');

Route::get('/client/logout', [AuthController::class, 'logout'])->name('client.logout');


Route::group(['middleware' => ['auth:client']], function () {
    Route::get('/client-profile', [AuthController::class, 'clientProfile'])->name('client.profile');
    Route::get('/donations', [MainController::class, 'donations'])->name('donations');
    Route::get('/donation-create', [MainController::class, 'donationCreate'])->name('donation.create');
    Route::post('/notification-settings', [MainController::class, 'notificationSettings'])->name('notification.settings');
    Route::get('/my-favourites', [MainController::class, 'myFavourites'])->name('client.favourites');
    Route::post('/toggle-favourites', [MainController::class, 'toggleFavourites'])->name('toggle.favourites');
    Route::get('/notification-settings', [AuthController::class, 'getNotificationSettings'])->name('get.notification.settings');
    Route::post('/notification-settings', [AuthController::class, 'saveNotificationSettings'])->name('save.notification.settings');
});
