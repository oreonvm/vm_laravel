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
                    <h1 class="m-0">New post</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/oreho" title="Admin home page">Home</a></li> &nbsp;&nbsp;
                        <li><a href="{{ route('posts.index') }}">List posts</li></a> &nbsp;&nbsp;
                        <li class="active">New post</li>
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
            <div class="col-md-9">
                <div class="box">
                    <form id="post" name="post" action="{{ route('postsAdmin.store', ['post' => ['id' => 'id']]) }}"
                        method="POST" data-toggle="validator">
                        @csrf
                        <div id="note"></div>
                        <div class="form-group has-feedback">
                            <label for="email">Email</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" id="email"
                                class="form-control" placeholder="E-mail *" autocomplete="off" value="{{ old('email') }}"
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
                            <textarea name="content" class="form-control" cols="10" rows="10" placeholder="content"
                                value="{{ old('content') }}" class="@error('content') is-invalid @enderror"></textarea>
                        </div>

                        <div class="form-group has-feedback">
                            <label for="category_id">Category </label>
                            {{-- <select name="category_id" id="category_id"> --}}
                            <select class="form-select" name="category_id" id="category_id"
                                aria-label="Default select example" class="@error('category_id') is-invalid @enderror">
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
                            <select name="tags[]" id="tags" class="select2" multiple="multiple"
                                data-placeholder="Select a Tags" style="width: 100%;">
                                <option>Select tags </option>
                                @foreach ($tags as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" name="create" id="create" class="btn btn-default">Send</button>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    {{-- </div> --}}
    <!-- /.content -->
@endsection
