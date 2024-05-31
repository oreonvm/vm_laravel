<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="/oreho">
    {{-- <link href='http://xxxx.com/images/star.png' rel='shortcut icon' type='image/x-icon' /> --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js',
        'resources/oreho/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        'resources/oreho/plugins/fontawesome-free/css/fontawesome.min.css',
        'resources/oreho/dist/css/adminlte.min.css',
        'resources/oreho/plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        // 'resources/oreho/jquery.min.js',
        //  'resources/oreho/plugins/bootstrap/js/bootstrap.min.js',
    ])
    <title>Admin ПАНЕЛЬ | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    {{-- <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> --}}
    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="plugins/fontawesome-free/css/fontawesome.min.css"> --}}
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css"> -->
    <!-- Theme style -->
    {{-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> --}}
    <!-- iCheck -->
    {{-- <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css"> --}}
    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page">

    <div class="login-box">
        <div class="login-logo">
            <b>Admin ПАНЕЛЬ</b>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form id="login" name="login" action="{{ route('login_oreho') }}" method="POST" role="form">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control"
                            placeholder="email"autocomplete="off" value="{{ old('email') }}"
                            class="@error('email') is-invalid @enderror">
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <!-- <div class="input-group-append"> -->
                        <div class="input-group-text">
                            <img src="{{ Vite::asset('resources/oreho/dist/img/user.jpg') }}" alt="user">
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <!-- <div class="input-group-append"> -->
                        <div class="input-group-text">
                            <!-- <span class="fa fa-lock"></span> -->
                            <img src="{{ Vite::asset('resources/oreho/dist/img/lock.jpg') }}" alt="lock">
                        </div>
                        <!-- </div> -->
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" name="oreho" class="btn btn-primary">Sign In</button>
                        </div>
                        <!-- /.col -->
                        <span style="margin: 0 auto; font-weight: 500;"><a href="/" title="Home page"
                                class="nav-link">Home</a></span>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.login-box-body -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Bootstrap 4.6.2 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous">
        < script src = "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/js/src/util.js" >
    </script>

</body>

</html>
