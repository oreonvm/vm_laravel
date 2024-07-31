@extends('layouts.main')
@extends('layouts.footer_account')

@section('content')
    <nav>
        <label for="drop" class="toggle"><img src="/images/menu-48.png" width="38" alt=""> Menu</label>
        <input type="checkbox" id="drop">
        <ul class="menu">
            {!! $menu !!}
        </ul>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-9">
                @if (Session::has('status'))
                    <div class="alert alert-success">
                        {{ Session::get('success', 'Вам отправлена ссылка на Вашу почту, чтобы обновить Ваш пароль ') }}
                    </div>
                @endif
            </div>
        </div>
    </div>


    <div class="container">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 m-auto">

            @if ($errors->any())
                <div class="alert alert-danger">{{ $message = 'This email does not exist!' }}
                </div>
            @endif

            <h1 class="title_product">Enter your email for reset password</h1>
            <form name="email" action="{{ route('password.email') }}" method="POST">
                @csrf
                {{-- @method('post') --}}
                <div id="note"></div>
                <div class="form-group has-feedback">

                    <label for="email">Email</label><span class="icon_email_passw"><img src="/images/email_icon.png"
                            width="25" alt="email"></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" id="email"
                        class="form-control" placeholder="E-mail *" autocomplete="off" value=""
                        class="@error('email') is-invalid @enderror">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <button type="submit" id="create" style="margin-top: 10px;font-size:12px; width: 25%;">Email</button>
                <!-- </div> -->
            </form>
        </div>

    </div>
@endsection
