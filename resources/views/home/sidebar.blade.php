<div id="sidebar" class="col-6 col-md-3">
    <h1 class="title">RIGHT PART - POSTS users</h1>
    @foreach ($posts as $post)
        <div class="block_post">
            <h4 class="name_post">{{ $post->title }}</h4><br>
            <p class="post"> <a href="{{ route('post', $post->id) }}" target="_blank" rel="noopener noreferrer">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" width="60" alt="image_post"
                            title="image_post" align="left">
                    @else
                        <img src="{{ Vite::asset('resources/oreho/dist/img/No_image.png') }}" title="No_image"
                            width="60" alt="no_image">
                    @endif
                    @php
                        $post->content = strip_tags($post->content);
                        $post->content = substr($post->content, 0, 60);
                        $post->content = rtrim($post->content, '!,.-');
                        $post->content = substr($post->content, 0, strrpos($post->content, ' '));
                        echo $post->content .
                            '<span style="color: blue; font-weight:600;"><br>(Подробнее)</span></a> </p>';
                    @endphp
                    <i class="fa fa-eye"></i><small>&nbsp;{{ $post->views }} views</small>
                    <small><span class="date"> {{ $post->getPostDate() }}</span></small>

        </div>
    @endforeach

    {{ $posts->onEachSide(2)->links('vendor.pagination.my_pagination') }}

</div>
