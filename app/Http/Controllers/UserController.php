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
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Console\View\Components\Alert;

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
    public static function sendResetLink(Request $request)
    {
        $address = $request->email;
        $user = User::where('email', $address)->first();
        if ($user) {
            $token = bin2hex(random_bytes(32));
            $tstamp = $_SERVER["REQUEST_TIME"];
            //==== ПОСЛЕ ВВОДА email и ОТПРАВКИ ЕГО  УДАЛЯЕМ ОБНОВЛЕНИЕМ ВСЕ СТАРЫЕ token и tstamp ====
            DB::update("update users set token = ?, tstamp = ? where id = ?", ["", 0, $user['id']]);
            DB::update("update users set token = ?, tstamp = ? where id = ?", ["{$token}", "{$tstamp}", $user['id']]);

            $link_new_passw = "<a style='width:300px;margin: 70px auto;font-size: 15px;font-weight: 600;' href='https://example.com/reset-password/{$token}' >
           Updating your password</a>";
            $sender = "Laravel";
            $email = "On@gmail.com";
            $sub = "Dear {$user['name']}! Please,update your password";
            $mes = '<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Password</title>
	<style>.container_passw {
	padding: 20px 35px; border-radius: 12px; width: 500px; height: 300px;margin: 30px auto 10px; background-color:#f8e4a3;
	}
	@media (max-width:769px){
     .container_passw {
	     width: 300px;
	     height: auto;
	     margin: 10px auto 10px;
      }
	 .container_passw span {
	     margin-top: 10px;
	     margin-bottom: 30px;
	  }
	 } </style>
</head>
<body>
	<div class="container_passw">
	<h2 style="text-align: center;color: green;">Dear ' . $user['name'] . '! Updating your password</h2><br>
	<p style="font-weight: 600; font-size: 14px; text-align: center; color: black;">Перейдите по этой ссылке, чтобы ввести НОВЫЙ ВАШ ПАРОЛЬ.
		Будьте внимательны ! - ссылка действительна в течение 5 минут.</p><br>
      <span style="text-align: center; margin-top: 10px;margin-left: 30px;">' . $link_new_passw;
            '</span>
	</div>
</body>
</html>';
            $headers = "Content-type:text/html; charset = UTF-8\r\nFrom:$sender <contact>\r\nReply-To:$email";
            $headers .= "Content-Type: multipart/form-data\r\n";

            mail($address, $sub, $mes, $headers);
            // return redirect('/forgot-password')->with('success', 'Вам отправлена ссылка на Вашу почту, чтобы обновить Ваш пароль');
            return back()->with('status', 'Уваж. ' . $user['name'] . '! Вам отправлена ссылка на Вашу почту, чтобы обновить Ваш пароль');
        } else {
            return back()->withErrors(['email']);
        }
    }

    public static function newPassw(Request $request)
    {
        $token = $request->token;
        $user = User::where('token', $token)->first();
        $tstamp_current = $user['tstamp'];
        // dd($user);
        $credentials = $request->validate([
            'token' => 'required',
            'password' => [
                'required',
                RulesPassword::min(12)
                    ->letters()
                    ->numbers()
                    ->symbols(),
                'confirmed'
            ],
        ]);
        $user->fill([
            'password' => Hash::make($request->password)
        ])->save();
        return back()->with('status', 'Dear. ' . $user['name'] . '! Your password has been changed!');

        if (!$user) {
            return back()->withErrors([
                'message' => 'Your password cannot be changed!??!',
            ]);
        }
        return view('user.reset-password', compact('user', 'credentials'), ['token' => $token]);
    }
}
