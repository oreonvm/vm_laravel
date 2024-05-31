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
            <div id="content" class="col-xs-6 col-sm-6 col-md-12">
                @include('layouts.category_tag')

                <div id="main_center" class="col-xs-6 col-md-6">
                    <h3>Central part of website</h3>
                    <img src="{{ Vite::asset('resources/oreho/dist/img/1-interior-8.jpg') }}" title="picture1"
                        alt="picture">
                    <div class="block_post">
                        <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum veritatis,
                            aliquid voluptate aperiam, commodi sed perferendis doloribus
                            id aspernatur porro a laudantium sit soluta suscipit quod
                            facilis atque. Officiis, consequuntur?</p>
                    </div>
                    <img src="{{ Vite::asset('resources/oreho/dist/img/interior-1.jpg') }}" title="picture2" alt="picture">
                    <div class="block_post">
                        <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum veritatis,
                            aliquid voluptate aperiam, commodi sed perferendis doloribus
                            id aspernatur porro a laudantium sit soluta suscipit quod
                            facilis atque. Officiis, consequuntur?</p>
                    </div>
                </div>
                @include('home.sidebar')

            </div>

        </div>
    </div>
@endsection
