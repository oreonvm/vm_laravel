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
        <div id="content" class="col-xs-12 col-sm-12 col-md-8">
            {{-- <h1 class="title_product">LEFT PATH</h1>
            <div class="block_post">
                <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsum veritatis,
                    aliquid voluptate aperiam, commodi sed perferendis doloribus
                    id aspernatur porro a laudantium sit soluta suscipit quod
                    facilis atque. Officiis, consequuntur?</p>
            </div>
            <h4 class="title_product"> NEXT SECTION</h4>
            <div class="block_post">
                <p class="text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore eius
                    fugiat ad assumenda cumque laborum nihil porro blanditiis ipsam eveniet veritatis,
                    totam quos quis vel quas quo. Rem, in voluptates.</p>
            </div>

            {{-- @dd($categories_title) --}}
            {{-- @dd($posts[0]['category_id']) // 3 --}}
            {{-- @dd($posts) --}}
            @foreach ($posts_cat as $post)
                @if ($post->category->id === $posts[0]['category_id'])
                    <h4 class="title_product">{{ $post->category->title }} <br>{{ $post->title }}</h4>

                    <div class="block_post">
                        <p><img src="{{ asset('storage/' . $post->image) }}" width="60" alt=""><br>
                            {!! htmlspecialchars_decode($post->content) !!}</p>
                    </div>
                @endif
            @endforeach
            {{ $posts->onEachSide(2)->links('vendor.pagination.my_pagination') }}
        </div>
        <div id="sidebar" class="col-xs-12 col-md-3">
            <h1 class="title">RIGHT PATH - POSTS users</h1>
            @foreach ($posts as $post)
                <div class="block_post">
                    <h4 class="name_post">{{ $post->title }}</h4><br>
                    <p class="post"> <a href="{{ route('post', $post->id) }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('storage/' . $post->image) }}" width="60" alt="" align="left">
                            @php
                                $post->content = strip_tags($post->content);
                                $post->content = substr($post->content, 0, 60);
                                $post->content = rtrim($post->content, '!,.-');
                                $post->content = substr($post->content, 0, strrpos($post->content, ' '));
                                echo $post->content .
                                    '<span style="color: blue; font-weight:600;">&nbsp;&nbsp;(Подробнее)</span></a> </p>';
                            @endphp
                            <span class="date"> {{ $post->getPostDate() }}</span>
                </div>
            @endforeach

            {{ $posts->onEachSide(2)->links('vendor.pagination.my_pagination') }}
        </div>

    </div>


    {{-- {{ $content }} --}}
    {{--  =======>> РАСПАРСИМ  МАССИВ users В СТРОКУ --}}
    {{-- {{ json_encode($users) }}  --}}

    {{-- ====>> ВЫТАЩИМ КАКОГО-НИБУДЬ user --}}


    {{-- ======================>> КАК РАБОТАЕТ ЦИКЛ  @foreach ===== --}}
    {{-- {{ $users[0]['email'] }}
    @foreach ($users as $user)
        {{ $user['email'] }}<br>
    @endforeach --}}
    {{-- ====>> ВЫВОД ВСЕХ email users --}}

    {{-- ======================>> КАК РАБОТАЕТ ЦИКЛ  @forelse  ==== --}}
    {{-- @php
        $users2 = [];
    @endphp
    @forelse ($users as $user)
        {{ $user['email'] }} <br>
    @empty
        <p>No users</p>
    @endforelse --}}
    {{-- ======================>> КАК РАБОТАЕТ ЦИКЛ  @for --}}
    {{-- @for ($i = 1; $i < count($users); $i++)
        {{ $i }} <br>
    @endfor --}}
    {{-- ======>> ВЫВОД  == 9  --}}

    {{-- =======>> В ЦИКЛЕ  ЗАКРАШИВАЮТСЯ в КРАСНЫЙ ЦВЕТ  ЧЕТНЫЕ ИТЕРАЦИИ
    ЕСЛИ   $loop->even ИЛИ НЕЧЕТНЫЕ ИТЕРАЦИИ ЕСЛИ $loop->odd ====== --}}
    {{-- @foreach ($users as $user)
        <span @style(['color:red' => $loop->odd])>
            {{ $loop->iteration }}
            {{ $user['email'] }}<br>
        </span>
    @endforeach <br> --}}



    {{-- ========================>> ЗДЕСЬ  ПОСТЫ  ===================== --}}
    {{-- @foreach ($posts as $post)
        {{ $post->title }}: {{ $post->content }} = {{ $post->getPostDate() }} <br>
    @endforeach --}}
@endsection
