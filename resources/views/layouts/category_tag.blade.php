<div id="category_tag">
    <div class="col-6 col-md-3">
        <div class="title">Категории и их посты </div>
        @foreach ($categories as $category)
            <ul class="menu_drop">
                <li class="item"><a name="category" class="accordion" data-toggle="collapse">
                        &nbsp;&nbsp;{{ $category->title }}</a>
                    <ul style="display: none;">
                        @foreach ($posts_cat as $post)
                            @if ($post->category->id == $category->id)
                                <li class="subitem">
                                    @if ($post->image)
                                        <img src="{{ asset('storage/' . $post->image) }}" width="20"
                                            alt="image_post" title="image_post" align="left">
                                    @else
                                        <img src="{{ Vite::asset('resources/oreho/dist/img/No_image.png') }}"
                                            title="No_image" width="20" alt="no_image">
                                    @endif
                                    &nbsp;&nbsp;&nbsp;<a href="{{ route('post', $post->id) }}" target="_blank"
                                        rel="noopener noreferrer">
                                        {{ $post->title }} <br></a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        @endforeach
    </div>

    <div class="col-6 col-md-3">
        <div class="title">Теги и их посты </div>
        @foreach ($tags as $tag)
            <ul class="menu_drop">
                <li class="item"><a name="tag" class="accordion" data-toggle="collapse">
                        &nbsp;&nbsp;{{ $tag->title }}</a>
                    <ul style="display: none;">
                        @php
                            $postTag = $tag->posts->all();
                        @endphp
                        @foreach ($tag->posts as $post)
                            <li class="subitem">
                                @if ($post->image)
                                    <img src="{{ asset('storage/' . $post->image) }}" width="20" alt="image_post"
                                        title="image_post" align="left">
                                @else
                                    <img src="{{ Vite::asset('resources/oreho/dist/img/No_image.png') }}"
                                        title="No_image" width="20" alt="no_image">
                                @endif
                                &nbsp;&nbsp;&nbsp;<a href="{{ route('post', $post->id) }}" target="_blank"
                                    rel="noopener noreferrer">
                                    {{ $post->title }} <br></a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        @endforeach
    </div>
</div>
