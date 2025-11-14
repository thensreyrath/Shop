<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontend\HomeController;
use App\Http\Controllers\backend\AdminController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\backend\CategoriesController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\QrController;
use App\Http\Controllers\form\GenPassController;
use App\Http\Controllers\frontend\PaymentController;
use App\Http\Controllers\frontend\SettingController;
use App\Http\Controllers\Frontend\ShopController;
use App\Models\Order;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Home
// Route::get('/', function () {
//     return redirect('signin');
// });
Route::get('/',                 [HomeController::class, 'Home']);
// Route::get('/shop',             [ShopController::class, 'shop']);
Route::get('/shop',             [HomeController::class, 'Shop']);
// Route::get('/product/{id}', [HomeController::class, 'Product']);
Route::get('/product/{slug}',   [HomeController::class, 'Product']);
Route::get('/news',             [HomeController::class, 'News']);
Route::get('/article',          [HomeController::class, 'Article']);
Route::get('/search',           [HomeController::class, 'Search']);




// User SignIn & SignUp
Route::get('/signin',         [UserController::class, 'Signin'])->name('login');
Route::post('/signin-submit', [UserController::class, 'SigninSubmit']);

Route::get('/signup',         [UserController::class, 'Signup']);
Route::post('/signup-submit', [UserController::class, 'SignupSubmit']);

// @Middleware Auth
Route::middleware(['auth'])->group(function () {

    // Sample
    Route::get('/admin',             [AdminController::class, 'index']);
    Route::get('/admin/add-post',    [AdminController::class, 'AddPost']);
    Route::get('/admin/list-post',   [AdminController::class, 'ListPost']);
    
    // User Logout
    Route::get('/signout',           [UserController::class, 'SignOut']);

    //List Log Activities
    Route::get('/admin/log-activity',         [AdminController::class, 'ViewLog']);

    //Website Logo
    Route::get('/admin/list-logo',            [AdminController::class, 'ListLogo']);
    Route::get('/admin/add-logo',             [AdminController::class, 'AddLogo']);
    Route::post('/admin/add-logo-submit',     [AdminController::class, 'AddLogoSubmit']);
    Route::get('/admin/update-logo/{id}',     [AdminController::class, 'UpdateLogo']);
    Route::post('/admin/update-logo-submit',  [AdminController::class, 'UpdateLogoSubmit']);
    Route::post('/admin/remove-logo-submit',  [AdminController::class, 'RemoveLogoSubmit']);

    //Category
    Route::get('/admin/list-category',        [CategoriesController::class, 'ListCategory']);
    Route::get('/admin/add-category',         [CategoriesController::class, 'AddCategory']);
    Route::post('/admin/add-category-submit',  [CategoriesController::class, 'AddCategorySubmit']);
    Route::post('/admin/update-category',  [CategoriesController::class, 'categoryUpdate']);
    Route::post('/admin/category-remove',  [CategoriesController::class, 'removeCate']);


    //Attribute
    Route::get('/admin/list-attribute',       [CategoriesController::class, 'ListAttribute']);
    Route::get('/admin/add-attribute',        [CategoriesController::class, 'AddAttribute']);
    Route::post('/admin/add-attribute-submit',[CategoriesController::class, 'AddAttributeSubmit']);
    Route::get('/admin/edit/{id}',[CategoriesController::class, 'edit']);
    Route::post('/admin/update',[CategoriesController::class, 'update']);
    Route::post('/admin/delete',[CategoriesController::class, 'delete']);


    //Product
    Route::get('/admin/list-product',         [ProductController::class, 'ListProduct']);
    Route::get('/admin/add-product',          [ProductController::class, 'AddProduct']);
    Route::post('/admin/add-product-submit',  [ProductController::class, 'AddProductSubmit']);
    Route::get('/admin/update-product/{id}',       [ProductController::class, 'updateProduct']);
    Route::post('/admin/update-product-submit',  [ProductController::class, 'updateProductSubmit']);
    Route::post('/admin/product-remove',       [ProductController::class, 'destroy']);

    //CallQR
    Route::post('/callqr', [HomeController::class, 'callQr'])->name('callqr');
    Route::get('/setting' , [SettingController::class, 'setting']);
    
    // Payment
    Route::get('/payment-success/{orderid}' , [PaymentController::class, 'pay']);
    // Route::get('/payment/{orderid}',             [PaymentContoller::class, 'productPay']);
    // Route::get('/payment-success',             [PaymentContoller::class, 'payment']);
    // Route::get('/decline',             [PaymentContoller::class, 'paydecline']);

    /// Generate Password
    Route::get('/generate', [GenPassController::class, 'index'])->name('generate');
    Route::post('/change-pass', [GenPassController::class, 'generatePassword'])->name('change-pass');

});
