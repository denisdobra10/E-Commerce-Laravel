<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrdersController;
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

Route::get('/', function () {
    return view('home');
});


// ADMINISTRATOR FUNCTIONS

Route::get('/createproduct', function () {
    return view('admin.add-product');
});

Route::post('/createproduct', [ProductController::class, 'CreateProduct']);
//

// Login routes
Route::get('/login', function () {
    return view('users.login');
});

Route::post('/login', [UsersController::class, 'login']);

Route::get('changepassword', function()
{
    return view('users.changepass');
});

Route::post('changepassword', [UsersController::class, 'ChangePassword']);

Route::get('showorders', [OrdersController::class, 'showorders']);

Route::post('finishorder', [OrdersController::class, 'MarkOrderAsFinished']);

Route::post('deleteallorders', [OrdersController::class, 'DeleteAllOrders']);

Route::post('deleteorder', [OrdersController::class, 'DeleteOrder']);

//


// Registration routes
Route::get('/register', function () {
    return view('users.register');
});

Route::post('/register', [UsersController::class, 'register']);
//

// Log out

Route::get('/logout', [UsersController::class, 'logout']);

//



// Product routes
Route::get('/index', [ProductController::class, 'index']);

Route::get('details/{id}', [ProductController::class, 'details']);

Route::get('edit/{id}', [ProductController::class, 'EditProduct']);

Route::get('delete-product/{id}', [ProductController::class, 'DeleteProduct']);


// Cart routes
Route::post('add-to-cart', [ProductController::class, 'AddToCart']);

Route::post('buynow', [ProductController::class, 'BuyNow']);

Route::post('edit/edit-product', [ProductController::class, 'ModifyProduct']);

Route::get('showcart', [ProductController::class, 'CartList']);

Route::get('cart-delete-item/{id}', [ProductController::class, 'RemoveProductFromCart']);


// Order routes
Route::get('order', function () {
    return view('products.order');
});

Route::post('placeorder', [ProductController::class, 'PlaceOrder']);
