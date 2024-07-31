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
            <div id="content" class="col-12 col-xs-12 col-sm-12 col-md-12">
                @include('layouts.category_tag')

                <div id="" class="col-12 col-sm-12 col-xs-12 col-md-9 col-lg-9">
                    @if ($posts->count())
                        @foreach ($posts as $post)
                            <div class="block_post">
                                <h1 class="title_post">
                                    @php
                                        $s_mark = "<mark style='background-color: #ebea8e;'>" . $s . '</mark>';
                                        $post->title = str_replace("{$s}", "{$s_mark}", " {$post->title}");
                                    @endphp
                                    {!! htmlspecialchars_decode($post->title) !!}
                                </h1>
                                @php
                                    $post_date = date('d.m.Y H:i', strtotime($post->updated_at));
                                @endphp
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" width="30" alt="image_post"
                                        title="image_post">
                                @else
                                    <img src="{{ Vite::asset('resources/oreho/dist/img/No_image.png') }}" title="No_image"
                                        width="80" alt="no_image">
                                @endif

                                {{-- <img src="{{ asset('storage/' . $post->image) }}" width="200" alt=""> --}}
                                <small>
                                    <div class="date_post">Last view: {{ $post_date }}</div>
                                </small>
                                &nbsp;&nbsp;<div class="data_views">
                                    <i class="fa fa-eye"></i><small>&nbsp;{{ $post->views }}</small>
                                </div>
                                <p class="text"> <a href="{{ route('post', $post->id) }}" target="_blank"
                                        rel="noopener noreferrer">
                                        @php
                                            $post->content = strip_tags($post->content);
                                            $post->content = substr($post->content, 0, 60);
                                            $post->content = rtrim($post->content, '!,.-');
                                            $post->content = substr($post->content, 0, strrpos($post->content, ' '));
                                            $post->content = trim(
                                                str_ireplace("{$s}", "{$s_mark}", "{$post->content}"),
                                            );
                                        @endphp
                                        {!! htmlspecialchars_decode($post->content) !!}
                                        <span style="color: blue; font-weight:600;"><br>(Подробнее)</span></a> </p>
                            </div>
                        @endforeach
                        {{ $posts->appends(['s' => request()->s])->links('vendor.pagination.my_pagination') }}
                    @else
                        <p
                            style="margin:0 auto; padding: 0 30px 50px; background-color: #e5e573; font-size: 18px; font-weight: 600;color: red;border-radius: 19px;">
                            <br><br>
                            Sorry, unfortunately nothing according to your request...
                        </p>
                    @endif
                </div>


            </div>

        </div>
    </div>
@endsection
