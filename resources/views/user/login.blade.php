@extends('layouts.main')
@extends('layouts.footer')

@section('content')
    <nav>
        <label for="drop" class="toggle"><img src="/images/menu-48.png" width="38" alt=""> Menu</label>
        <input type="checkbox" id="drop">
        <ul class="menu">
            {!! $menu !!}
        </ul>
    </nav>
    <div class="container">
        <div class="col-xs-12 col-sm-12">
            @if (Session::has('status'))
                <div class="alert alert-success">
                    {{ Session::get('success', 'Вы успешно зарегистрировались!') }}
                </div>
            @endif
            <h1 class="title_product">Login</h1>
            <form id="login" name="login" action="{{ route('login') }}" method="POST">
                @csrf
                {{-- @method('post') --}}
                <div id="note"></div>
                <div class="form-group has-feedback">

                    <label for="email">Email</label><span class="icon_email_passw"><img src="/images/email_icon.png"
                            width="25" alt="email"></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" id="email"
                        class="form-control" placeholder="E-mail *" autocomplete="off" value="{{ old('email') }}"
                        class="@error('email') is-invalid @enderror">
                    @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <div class="form-group has-feedback">
                    <label for="password">Password</label><span class="icon_email_passw"><img src="/images/passw_icon.png"
                            width="35" alt="password"></span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" id="password"
                        class="form-control" placeholder="Password *" autocomplete="off"
                        class="@error('password') is-invalid @enderror">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" name="login" id="create" style="font-size:12px; width: 25%;">Login</button>
                <!-- </div> -->
                <span class="link_register"><a href="{{ route('register.registration') }}"
                        title="Register">Register</a></span>
            </form>

        </div>


    </div>
@endsection
