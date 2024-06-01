@extends('layouts.main')
@extends('layouts.footer')
{{-- @extends('layouts.alerts') --}}
{{-- @php
    header('Content-type: text/html');
@endphp --}}

@section('content')
    <nav>
        <label for="drop" class="toggle"><img src="/images/menu-48.png" width="38" alt=""> Menu</label>
        <input type="checkbox" id="drop">
        <ul class="menu">
            {!! $menu !!}
        </ul>
    </nav>
    <div id="center">New Post</div>
    @if (!$user)
        <div class="alert alert-danger">{{ $message = 'Please, authorize before to create post!' }}</div>
    @endif
    @if (Session::has('status'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif
    <form id="post" name="post" action="{{ route('posts.store', ['post' => ['id' => 'id']]) }}" method="POST"
        data-toggle="validator" enctype="multipart/form-data">
        @csrf
        <div id="note"></div>
        <div class="form-group has-feedback">
            <label for="email">Email</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" id="email" class="form-control"
                placeholder="E-mail *" autocomplete="off" value="{{ old('email') }}"
                class="@error('email') is-invalid @enderror">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group has-feedback">
            <label for="title">Title</label>
            &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="title" id="title" class="form-control"
                placeholder="Title" autocomplete="title" value="{{ old('title') }}"
                class="@error('title') is-invalid @enderror">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group has-feedback">
            <label for="content">Content</label>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <textarea name="content" id="content" class="form-control" cols="10" rows="10" placeholder="content"
                class="@error('content') is-invalid @enderror"></textarea>
        </div>
        <div class="form-group has-feedback">
            <label for="image">Image</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="image" id="image"
                class="form-control-file" placeholder="Choose image" class="@error('image') is-invalid @enderror">
            @error('image')
                <div class="alert alert-danger">{{ $message = 'The image field must be an image.' }}</div>
            @enderror
        </div>
        <div class="form-group has-feedback">
            <label for="category_id">Category</label>
            <select class="form-select" name="category_id" id="category_id" aria-label="Default select example"
                class="@error('category_id') is-invalid @enderror">
                <option selected>Select category</option>
                @foreach ($categories as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="tags">Tags</label>
            <select name="tags[]" id="tags" name="tags" class="select2" multiple="multiple"
                data-placeholder="Select a Tags" style="width: 100%;">
                <option>Select tags </option>
                @foreach ($tags as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        @if (!$user)
            <button type="submit" name="create" id="create" disabled>Send</button>
        @else
            <button type="submit" name="create" id="create">Send</button>
        @endif
    </form>

    {{-- =======================>> Editor tinymce ======================= --}}
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


    {{-- ===================>> CKEditor ======================= --}}

    {{-- <script src="{{ asset('assets/vendor/ckeditor5/build/ckeditor.js') }}"></script> --}}


    {{-- <script src="{{ asset('ckfinder/ckfinder.js') }}"></script>  --}}
    {{-- =================>> ИНИЦИАЛИЗИРУЕМ СКРИПТ ckfinder ================== --}}
    {{-- <script>
        ClassicEditor
            .create(document.querySelector('#content'), {
                plugins: [SimpleUploadAdapter,
                    '../assets/vendor/ckeditor5/packages/ckeditor5-upload/tests/adapters/simpleuploadadapter.js'
                ],
                ckfinder: {
                    uploadUrl: '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files&responseType=json',
                },
                toolbar: {
                    items: [
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
                    uploadUrl: 'images',

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
