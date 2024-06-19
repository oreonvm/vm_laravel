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
        <div class="post_show">
            @if (!@empty($post))
                <div id="content" class="col-xs-6 col-sm-6 col-md-8">
                    {{-- @include('../home/index') --}}
                    {{-- @php --}}
                    {{-- use App\Models\Post; --}}
                    {{-- $posts = Post::query()->orderBy('id', 'desc')->paginate(7); --}}
                    {{-- @endphp --}}

                    <div class="block_post">
                        <h1 class="title_post">{{ $post->title }}</h1>
                         @php
                            $post_date = date('d.m.Y H:i', strtotime($post->created_at));
                            $last_view = date('d.m.Y H:i', strtotime($post->updated_at));
                        @endphp
                        <img src="{{ asset('storage/' . $post->image) }}" width="200" alt="">
                        <small>
                            <div class="date_post">Create: {{ $post_date }}</div>
                            <div class="date_post">Last view: {{ $last_view }}</div>
                            <div class="user_post">Author:
                                @foreach ($users as $user)
                                    @if ($user->email == $post->email)
                                        {{ $user->name }}
                                    @endif
                                @endforeach
                            </div>
                        </small>
                        {{-- &nbsp;&nbsp;
                        <small>
                            <div class="date_post">Last view: {{ $last_view }}</div>
                        </small> --}}
                        &nbsp;&nbsp;<div class="data_views">
                            <i class="fa fa-eye"></i><small>&nbsp;{{ $post->views }} views</small>
                        </div>
                        {{-- <p class="text">{!! strip_tags($post->content) !!}</p> --}}
                        <p class="text">{!! htmlspecialchars_decode($post->content) !!}</p>
                    </div>
                @else
                    <div class="not_elements">No posts yet...</div>
            @endif
        </div>
        @include('home.sidebar')
    </div>
    </div>
@endsection
