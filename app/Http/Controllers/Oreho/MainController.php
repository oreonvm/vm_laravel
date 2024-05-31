<?php

namespace App\Http\Controllers\Oreho;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MainController extends Controller
{
    public function index()
    {
        // dd(Str::slug('привет  дорогой'));  // =====>> privet-dorogoi

        // dd($categories->posts());  // ПУСТО
        //============>>  СОЗДАДИМ  ТЕГИ  =================
        // Tag::create(['title' => 'Оперативная память']);
        //============>>  СОЗДАДИМ  КАТЕГОРИИ =================
        // Category::create(['title' => 'Телевизоры']);
        $categories = Category::all();
        $posts = Post::all();
        $tags = Tag::all();
        $users = User::all();
        $user = auth()->user();
        if (!$user || $user->is_admin != 1) abort(404, 'This page not found! ');
        if ($user->is_admin = 1) return view(
            'oreho.index',
            ['title' => 'Admin Panel'],
            compact('categories', 'posts', 'tags', 'users')
        );
    }

    // public function loginAdmin()
    // {
    //     $user = auth()->user();
    //     if ($user->is_admin == 1) return view('oreho.index', ['title' => 'Admin Panel']);
    //     elseif ($user->is_admin == 0)   return view('user.my_account', [
    //         'title' => 'User profile', 'description' => 'User profile'
    //     ], compact('user'));
    //     else return view('oreho.login_oreho');
    // $user = User::where('is_admin', 1)->get();
    // if ($user) return view('oreho.login_oreho');
    // else return redirect('/login');
    // }

    // public function loginOreho(Request $request): RedirectResponse
    // {
    //     $credentials = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //         // 'is_admin' => 1,
    //     ]);

    //     if (Auth::attempt($credentials)) {
    //         $request->session()->regenerate();
    //         // ===>> ЭТО ОБЯЗАТЕЛЬНО ДЛЯ БЕЗОПАСНОСТИ чтобы предотвратить фиксацию сессии с целью АТАК:
    //         // return redirect('user.my_account');
    //         return redirect()->intended('/oreho');
    //     }

    //     return back()->withErrors([
    //         'email' => 'Учетные данные не совпадают с нашими записями.',
    //     ])->onlyInput('email');

    //     // ПРОВЕРКА - АВТОРИЗОВАН ЛИ user :
    //     if (Auth::check()) {
    //         // АДМИН вошел в систему...
    //         return true;
    //     }
    // }

    // public function adminLte()
    // {
    //     return view('components.adminlte-layout');
    // }
}
