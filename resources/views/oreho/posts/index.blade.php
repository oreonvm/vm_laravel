@extends('oreho.layouts.main')
@extends('oreho.layouts.footer')
@extends('oreho.layouts.sidebar')
@section('content')

    <!-- Content Header (Page header) -->
    {{-- <div class="content-wrapper" style="min-height: 548.062px;"> --}}
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List of posts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/oreho" title="Admin home page">Home</a></li>&nbsp;&nbsp;
                        <li class="active">List of posts</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">

                        <div class="table-responsive">
                            <a href="{{ route('postsAdmin.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add post</a>
                            {{ $posts->onEachSide(2)->links('vendor.pagination.my_pagination') }}
                        </div>
                        @if (!@empty($posts) && count($posts))
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Content</th>
                                            <th>Tags</th>
                                            <th>Category_id</th>
                                            <th>Image</th>
                                            <th>Created_at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->slug }}</td>
                                                <td>{!! htmlspecialchars_decode($post->content) !!}}</td>
                                                <td>{{ collect($post->tags)->implode('title', ', ') }} <br>
                                                    {{-- ДВА ВАРИАНТА ВЫВОДА $podt->tags
                                                        {{ $post->tags->pluck('title')->join(',') }} --}}

                                                </td>
                                                {{-- {{ $post->tags()->sync('title') }} --}}
                                                <td align="center">{{ $post->category_id }}</td>
                                                <td>
                                                    @if (!@empty($post->image))
                                                        <img src="{{ asset('storage/' . $post->image) }}" width="100"
                                                            alt="">
                                                    @endif
                                                </td>
                                                <td>{{ $post->created_at }}</td>
                                                <td>
                                                    <a class="edit"
                                                        href="{{ route('postsAdmin.edit', ['post' => $post->id]) }}">
                                                        <i class="fa fa-pencil-alt"></i></a>&nbsp;&nbsp;
                                                    <form id="post" name="post"
                                                        action="{{ route('postsAdmin.destroy', ['post' => $post->id]) }}"
                                                        method="POST" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $post->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirm delete!')">
                                                            <i style="margin-left: 4px;"
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                    {{-- <a href="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                            class="delete text-danger">
                                                            <i style="margin-left: 4px;" class="fas fa-trash-alt"></i></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="not_elements"> Posts while not yet!!...</div>
                        @endif
                        {{ $posts->onEachSide(2)->links('vendor.pagination.my_pagination') }}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </section>
    {{-- </div> --}}
    <!-- /.content -->

@endsection
