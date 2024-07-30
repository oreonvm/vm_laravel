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
        <div class="row">
            <div class="col-9">
                @if (Session::has('status'))
                    <div class="alert alert-success">
                        {{ Session::get('success', 'Dear. ' . $user['name'] . '! Your password has been changed!') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-xs-12 col-sm-8 col-md-6 col-lg-4 m-auto">

            @if ($token && $current_time - $tstamp_current > 300)
                <div class="alert alert-danger">
                    {{ $message = 'The link has expired! You need return to the password recovery page!' }}
                </div>
            @endif
            <h1 class="title_product">Update your password</h1>
            {{-- @dd($user) --}}
            <form name="reset-password" id="reset-password" action="{{ route('password.update', ['token' => $token]) }}"
                method="POST">
                @csrf
                {{-- @method('post') --}}
                <div id="note"></div>
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
                <div class="form-group has-feedback">
                    <label for="password_confirmation">Confirm Password</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password_confirmation"
                        id="password_confirmation" class="form-control" placeholder="Confirm Password *" autocomplete="off"
                        class="@error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                @if ($token && $current_time - $tstamp_current > 300)
                    <button type="submit" name="reset-password" id="create"
                        style="margin-top: 10px;font-size:12px; width: 40%;" disabled>New Password</button>
                @else
                    <button type="submit" name="reset-password" id="create"
                        style="margin-top: 10px;font-size:12px; width: 40%;">New Password</button>
                @endif
                <!-- </div> -->
            </form>

        </div>


    </div>
@endsection
