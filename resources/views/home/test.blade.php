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
    <p>Здесь находится тестовая страница</p>
    {{ $name }}<br>
    {{ $age }}
@endsection
