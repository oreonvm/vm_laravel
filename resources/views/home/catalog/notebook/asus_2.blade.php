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
        <div id="content" class="col-xs-6 col-sm-6 col-md-12">
            <div class="col-6 col-md-8">
                <h1 class="title_product">ASUS model 17-xxxxs</h1>
                <div class="block_product">
                    <p>Информация подробная о товаре</p>
                </div>
            </div>
            @include('home.sidebar')
        </div>
    </div>
@endsection
