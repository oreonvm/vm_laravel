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
                <h1 class="title_product">List notebooks</h1>
                <table border="1" cellspacing="0">
                    <thead>
                        <tr>
                            <th>№№</th>
                            <th>DELL</th>
                            <th>HP</th>
                            <th>Acer</th>
                            <th>ASUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="">
                            <td>1</td>
                            <td><a href="./dell_inspiron">DELL Inspiron</a></td>
                            <td><a href="./hp_1">HP 1</a></td>
                            <td><a href="./acer_1">Acer 1</a></td>
                            <td><a href="./asus_1">ASUS 1</a></td>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><a href="./dell_2">DELL 2</a></td>
                            <td><a href="./hp_2">HP 2</a></td>
                            <td><a href="./acer_2">Acer 2</a></td>
                            <td><a href="./asus_2">ASUS 2</a></td>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td><a href="./dell_3">DELL 3</a></td>
                            <td><a href="./hp_3">HP 3</a></td>
                            <td><a href="./acer_3">Acer 3</a></td>
                            <td><a href="./asus_3">ASUS 3</a></td>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @php
                use App\Models\Post;
                $posts = Post::query()->orderBy('id', 'desc')->paginate(6);
            @endphp

            @include('home.sidebar')
        </div>
    </div>
@endsection
