@extends('oreho/layouts.main')
@extends('oreho.layouts.footer')
@extends('oreho.layouts.sidebar')

@section('content')
    
    <div class="container">
        <div id="content" class="col-xs-12 col-sm-12 col-md-8">
            <h1 class="title_product">{{ $post->title }}</h1>
            <div class="block_post">
                @php
                    $post_date = date('d.m.Y H:i', strtotime($post->updated_at));
                @endphp
                {{ $post_date }}
                <p class="text">{{ $post->content }}</p>
            </div>
        </div>
        
    </div>
@endsection
