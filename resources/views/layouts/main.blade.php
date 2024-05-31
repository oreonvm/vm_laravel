<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/oreho/plugins/fontawesome-free/css/fontawesome.min.css', 'resources/oreho/plugins/fontawesome-free/css/all.min.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- <link href="/css/style.css" rel="stylesheet" type="text/css" media="all"> --}}
    <link href="{{ asset('select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ asset('select2-bootstrap4-theme/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css"
        media="all">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all">

    {{-- <meta name="description" content=""> --}}
    @isset($description)
        <meta name='description' content="{!! json_encode($description) !!}">
    @endisset
    <title>{{ $title }}</title>
</head>

<body>
    <div id="logo">
        <h1><a href="{{ route('home.index') }}">L A R A V E L</a></h1>
        {{-- <img class="fon_img" src="/images/fon_laravel.jpg" alt="восход солнца"> --}}
    </div>

    @auth
        {{-- Пользователь аутентифицирован... --}}

        <div class="login_user">Welcome, {{ auth()->user()->name }}
            @if (auth()->user()->name)
                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" width="38" alt="">
            @endif
            <a href="{{ route('user.my_account') }}"><img src="/images/user-48.png" title="my_account" alt="my_account"></a>
            <a href="{{ route('logout') }}" title="logout">Logout</a>
        </div>
    @endauth

    @guest
        {{-- Пользователь не аутентифицирован... --}}
        <div class="login_user">
            <a href="{{ route('login.create') }}" title="login">Login</a>
            <a href="{{ route('register.registration') }}"><img src="/images/register-48_1.png" title="register"
                    alt="register"></a>
        </div>
    @endguest

    <div class="create_post"><a href="{{ route('posts.create') }}">
            <img src="/images/m_create-post_1.png" title="create post" alt="create_post"></a>
    </div>
    <div id="search">
        <form action="{{ route('search') }}" method="get" autocomplete="off">
            <input type="text" name="s" required>
            <input type="submit" value="">
        </form>
    </div>
    {{-- <div class="container">
        <div class="row">
            <div class="col-9">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div> --}}
    {{-- <div class="container">
        <div class="row">
            <div class="col-9">
                @if (Session::has('status'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
            </div>
        </div>
    </div> --}}
    @yield('content')
    @yield('footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ asset('select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


</body>

</html>
