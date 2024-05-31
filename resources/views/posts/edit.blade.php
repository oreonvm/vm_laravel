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

    <body>

        <form id="post" name="post" action="{{ route('posts.update', ['post' => $post->id]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="box-body">
                <div class="form-group has-feedback">
                    <label for="title">{{ $post->title }}</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title" id="title" class="form-control"
                        placeholder="Title" autocomplete="title" value="{{ old('title') }}"
                        class="@error('title') is-invalid @enderror">
                    @error('title')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group has-feedback">
                    <textarea name="content" class="form-control" cols="10" rows="10" id="content">
                         {{ $post->content }}
                         </textarea>
                </div>
                <div class="form-group has-feedback">
                    <label for="image">Image</label>
                    @if (!@empty($post->image))
                        <img src="{{ asset('storage/' . $post->image) }}" width="200"alt="image_post" title="image_post">
                    @else
                        <img src="{{ Vite::asset('resources/oreho/dist/img/No_image.png') }}" title="No_image"
                            width="200" alt="no_image">
                    @endif
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="image" id="image"
                        class="form-control-file" placeholder="Choose image" class="@error('image') is-invalid @enderror">
                    @error('image')
                        <div class="alert alert-danger">{{ $message = 'The image field must be an image.' }}</div>
                    @enderror
                </div>
                <div class="form-group has-feedback">
                    <label for="category_id">Category </label>
                    {{-- <select name="category_id" id="category_id"> --}}
                    <select class="form-select" name="category_id" id="category_id" aria-label="Default select example"
                        class="@error('category_id') is-invalid @enderror">
                        <option selected>Select category</option>
                        @foreach ($categories as $key => $value)
                            <option value=" {{ $key }}" @if ($key === $post->category_id) selected @endif>
                                {{ $value }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    {{-- {{ dd($post_tag) }} --}}
                    <select name="tags[]" id="tags" class="select2" multiple="multiple"
                        data-placeholder="Select a Tags" style="width: 100%;">
                        <option>Select tags </option>
                        @foreach ($tags as $key => $value)
                            @php
                                $postTag = $post->tags->pluck('id')->all();
                            @endphp
                            <option value="{{ $key }}" @if (in_array($key, $postTag)) selected @endif>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="box-footer">
                    <input type="hidden" name="id" value="{{ $post->id }}">
                    <button type="submit" name="store" id="create" class="btn btn-default">EDIT</button>
                </div>
            </div>
        </form>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.0.1/tinymce.min.js"
            integrity="sha512-KGtsnWohFUg0oksKq7p7eDgA1Rw2nBfqhGJn463/rGhtUY825dBqGexj8eP04LwfnsSW6dNAHAlOqKJKquHsnw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('/tinymce_7.0.1_dev/tinymce/js/tinymce/plugins/image/plugin.min.js') }}"></script>

        <script>
            tinymce.init({
                selector: '#content',
                width: 800,
                height: 400,
                image_title: true,
                automatic_uploads: true,
                images_upload_url: '/images',
                file_picker_types: 'image',
                plugins: [
                    'advlist', 'autolink', 'link', 'image', 'lists', 'charmap', 'preview', 'anchor', 'pagebreak',
                    'searchreplace', 'wordcount', 'visualblocks', 'visualchars', 'code', 'fullscreen',
                    'insertdatetime',
                    'media', 'table', 'emoticons', 'help'
                ],
                toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | ' +
                    'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                    'forecolor backcolor emoticons | help',
                menubar: 'favs file edit view insert format tools table help'
            });
        </script>




        {{-- ===================>>  CKEditor =================================== --}}
        {{-- <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script>
        <script src="{{ asset('assets/vendor/ckfinder/ckfinder.js') }}"></script> --}}

        {{-- <script type="module"
            src="{{ asset('/assets/vendor/ckeditor5/node_modules/@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter.js') }}">
        </script> --}}

        {{-- <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>  --}}
        {{-- =================>> ИНИЦИАЛИЗИРУЕМ СКРИПТ ckfinder ================== --}}
        {{-- <script>
            // import {
            //     SimpleUploadAdapter
            // } from '@ckeditor/ckeditor5-upload';
            ClassicEditor
                .create(document.querySelector('#content'), {
                    ckfinder: {
                        uploadUrl: '/assets/vendor/ckfinder/core/connector/php/connector.php',
                    },
                    toolbar: {
                        items: ['ckfinder', 'imageUpload', '|',
                            'heading',
                            'undo',
                            'redo',
                            '|',
                            'bold',
                            'link',
                            'bulletedList',
                            'numberedList',
                            'blockQuote',
                            'alignment',
                            'fontColor',
                            '|',
                            'outdent',
                            'indent',
                            '|',
                            'insertTable',
                            'image',
                            'imageUpload',
                            'mediaEmbed'
                        ]
                    },
                    simpleUpload: {
                        //  The URL that the images are uploaded to.
                        uploadUrl: '../images',

                        //   Enable the XMLHttpRequest.withCredentials property.
                        withCredentials: true,

                        //  Headers sent along with the XMLHttpRequest to the upload server.
                        headers: {
                            'X-CSRF-TOKEN': 'CSRF-Token',
                            Authorization: 'Bearer <JSON Web Token>'
                        }
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        </script> --}}
    @endsection
