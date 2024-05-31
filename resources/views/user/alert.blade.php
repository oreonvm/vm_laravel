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
    {{-- <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div> --}}
    @php
        // if (!empty($_POST)) {
        echo '<div class="alert alert-success">' . ($message = 'Вы успешно зарегистрировались!.' . '</div>');
        // }
    @endphp
@endsection





{{-- <div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div> --}}
