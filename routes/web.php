<?php

use app\controllers\UserController as ControllersUserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Oreho\CategoryController;
use App\Http\Controllers\Oreho\MainController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Oreho\AdminPostController;
use App\Http\Controllers\Oreho\TagController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Oreho\AdminUserController;
use App\Http\Controllers\SearchController;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as RulesPassword;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

//use App\Providers\RouteServiceProvider;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});
// ===>> Building routes for website - СОЗДАЕМ МАРШРУТЫ для ГЛАВНОЙ СТРАНИЦЫ и других страниц =======
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/test', [HomeController::class, 'test'])->name('home.test');

Route::get('/catalog/notebook/notebooks', [HomeController::class, 'catalog'])->name('home.catalog.notebook.notebooks');
Route::get('/catalog/notebook/{slug}', [HomeController::class, 'notebooks'])->name('home.catalog.notebook.{slug}');

Route::match(['post', 'get'], '/contact', [HomeController::class, 'contact'])->name('home.contact');
// Route::post('/contact', [HomeController::class, 'poluchitInfo'])->name('home.contact');

// ===>>  Receiving email with a screenshot from USERS ====
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/user/my_account', [UserController::class, 'my_account'])->name('user.my_account');
//  Route::get('/oreho', [UserController::class, 'is_admin'])->name('oreho');

// =================>>  Sending email  =========================
Route::get('/poslatyptichku', [ContactController::class, 'poslatyPtichku']);
Route::get('/user/alert', [UserController::class, 'alert']);

//   =================>>>  ДЛЯ АДМИНКИ =======================
// Route::group(['prefix' => '/oreho'], function () {
//     Route::get('/login_oreho', [MainController::class, 'loginAdmin'])->name('login.create');
//     Route::post('/login_oreho', [MainController::class, 'loginOreho'])->name('login');
// });

// ==================>> For unauthorized user  =================
Route::group(['prefix' => '/'], function () {
    Route::get('/register', [UserController::class, 'registration'])->name('register.registration');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
    Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

// ==================>> For authorized user ===========================
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');

/**
 * ===============>> Reset Password user =========================================
 */
// =================> FIRST ROUTE =======================
Route::get('/forgot-password', function () {
    return view('user.forgot-password', ['title' => 'Reset password']);
})->middleware('guest')->name('password.request');

// ========== SECOND ROUTE ==>> Processing form submission to send link to email
Route::post('/forgot-password', [UserController::class, 'sendResetLink'])->name('password.email');

/**
 *   THIRD ROUTE ===>> WHERE user AFTER RECEIVING email AND CLICKING ON THE LINK
* TO ENTER A NEW PASSWORD WILL BE REFERRED TO THE PASSWORD RESET FORM
 */
Route::get('/reset-password/{token}', function (string $token) {
    $current_time = time();
    $user = User::where('token', $token)->first();
    // dd($user);
    $tstamp_current = $user['tstamp'];
    // if ($tstamp_current = 0)  abort(404, 'This page not found! ');
    // ==================> as a possible option ===================================
    if ($token && $current_time - $tstamp_current > 320) {
        abort(404, 'This page not found! ');
    }
    //==============================================================================
    return view('user.reset-password', compact('user', 'token', 'tstamp_current', 'current_time'), ['title' => 'Update your password', 'token' => $token]);
})->middleware('guest')->name('password.reset');

/**
 *  FOURTH ROUTE ===>> Form processing AFTER ENTERING A NEW PASSWORD
 */
Route::post('/reset-password', [UserController::class, 'newPassw'])->name('password.update');

//====================  End Reset Password user =======================================

// ===============>> Routes for Admin panel  =============================
Route::group(['prefix' => 'oreho'], function () {
    Route::get('/login_oreho', [UserController::class, 'loginAdmin'])->name('login.oreho');
    Route::post('/', [UserController::class, 'loginOreho'])->name('login_oreho');
    Route::get('/logout', [UserController::class, 'logoutAdmin'])->name('logoutAdmin');
    // });
    // ======>> For all files in the admin area =================
    Route::get('/', [MainController::class, 'index']);
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/users', AdminUserController::class);
    // ===========================>>  Posts for Admin area ===================================
    Route::resource('/posts', AdminPostController::class);
    Route::get('/posts/create', [AdminPostController::class, 'create'])->name('postsAdmin.create');
    Route::post('/posts', [AdminPostController::class, 'store'])->name('postsAdmin.store');
    Route::get('/posts/{post}/edit/', [AdminPostController::class, 'edit'])->name('postsAdmin.edit');
    Route::put('/posts/{post}', [AdminPostController::class, 'update'])->name('postsAdmin.update');
    Route::delete('/posts/{post}', [AdminPostController::class, 'destroy'])->name('postsAdmin.destroy');
    //=====================>> USERS for Admin area ======================================
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
    // Route::get('/users/{user}/edit/', [AdminUserController::class, 'edit'])->name('users.edit');
    // Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
    //  =====================>>  Categories for Admin area  ===================================
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit/', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    // ===========================>> Tags for Admin area ====================================
    Route::get('/tags/create', [TagController::class, 'create'])->name('tags.create');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{tag}/edit/', [TagController::class, 'edit'])->name('tags.edit');
    Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');
});
// =====================================================================
// ====================>> Posts on website  ========================================

Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{post}/edit/', [PostController::class, 'edit'])->name('posts.edit');
// Route::put('/posts/edit/{id?}', [PostController::class, 'update'])->name('posts.update');
Route::put('/posts/{post}', [PostController::class, 'updatePost'])->name('posts.update');
Route::get('/posts/post/{id?}', [PostController::class, 'show'])->name('post');
// Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
// ========>>> ОТПРАВКА ПОСТА и СОХРАНЕНИЕ ЕГО  ==================================
// ============>>  МАРШРУТ для ЗАНРУЗКИ В ПОСТАХ КАРТИНОК  =======================
// Route::post('/upload/post-image', 'PostController@uploadImage')->name('upload.post.image');






/**
 *   ====>> ЕСЛИ НА САЙТЕ ВОЗМОЖНЫ КАКИЕ-ТО НЕСУЩЕСТВУЮЩИЕ ЗАПРОСЫ
 *  ТО МОЖНО СДЕЛАТЬ ТАК, ЧТОБЫ ВСЕ ЭТИ НЕСУЩЕСТВУЮЩИЕ ЗАПРОСЫ
 * ПЕРЕАДОЕСОВЫВАЛИСЬ НА НАПРИМЕР ГЛАВНУЮ СТРАНИЦУ с ПОМ ЙУНКЦИИ fullback
 *  REDIRECTION on the page - NOT FOUND PAGE 
 */
Route::fallback(function () {
    //return redirect('home');
    // ИЛИ  ПЕРЕАДРЕСОВЫВАЛИСЬ  НА СТРАНИЦУ 404 ВОТ ТАК
    abort(404, 'This page not found! ');
});
