<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
//use Illuminate\Http\Client\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function Laravel\Prompts\info;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules\Password as RulesPassword;

class UserController extends Controller
{

    public function registration()
    {
        return view('user.register', ['title' => 'Registration', 'description' => 'Registration user']);
    }

    public function alert()
    {
        return view('user.alert', ['title' => 'Success Response']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                RulesPassword::min(12)
                    ->letters()
                    ->numbers()
                    ->symbols(),
                'confirmed'
            ],
            'avatar' => 'nullable|image',
        ]);

        if ($request->hasFile('avatar')) {
            $folder = date('Y-m-d');
            $avatar = $request->file('avatar')->store("images/{$folder}");
        }
        // dd($request->all());

        $user =  User::create([
            'name' => $request->name,
            'email'  => $request->email,
            'password' =>  Hash::make($request->password),
            'avatar' => $avatar ?? null,
        ]);
        return redirect('/login')->with('status', "You have successfully registered!");
        // return redirect('/login');
    }

    public function loginForm()
    {
        return view('user.login', ['title' => 'Login user']);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // ===>> ЭТО ОБЯЗАТЕЛЬНО ДЛЯ БЕЗОПАСНОСТИ чтобы предотвратить фиксацию сессии с целью АТАК:
            // return redirect('user.my_account');
            return redirect()->intended('/user/my_account')->with('success', "You have successfully logged in!");
        }

        return back()->withErrors([
            'email' => 'Your email or password is invalid!',
        ])->onlyInput('email');

        // ПРОВЕРКА - АВТОРИЗОВАН ЛИ user :
        if (Auth::check()) {
            return redirect('/user/my_account')->with('success', "You have successfully logged in!");
            // Пользователь вошел в систему...
            //     return true;
        }
    }

    public function loginAdmin()
    {
        return view('oreho.login_oreho', ['title' => 'Login Admin']);;
    }

    public function logoutAdmin()
    {
        Auth::logout();
        return redirect('/oreho/login_oreho');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    /**
     * Показать профиль для указанного пользователя.
     */
    public function my_account()
    {
        $user = auth()->user();
        if (!$user) return redirect('/login');
        if ($user->is_admin == 1) return redirect('/oreho/login_oreho');
        else return view('user.my_account', [
            'title' => 'User profile', 'description' => 'User profile'
        ], compact('user'));
    }


    public function loginOreho(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            // ===>> ЭТО ОБЯЗАТЕЛЬНО ДЛЯ БЕЗОПАСНОСТИ чтобы предотвратить фиксацию сессии с целью АТАК:
            // return redirect('user.my_account');
            return redirect()->intended('/oreho')->with('success', "You are as Admin log in successful!");
        }

        return back()->withErrors([
            'email' => 'Учетные данные не совпадают с нашими записями.',
        ])->onlyInput('email');

        // ПРОВЕРКА - АВТОРИЗОВАН ЛИ user :
        if (Auth::check()) {
            // АДМИН вошел в систему...
            return true;
        }
    }
}
