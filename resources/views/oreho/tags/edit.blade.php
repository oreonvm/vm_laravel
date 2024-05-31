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
                    <h1 class="m-0">Edit tag &nbsp;&nbsp;&nbsp;<span style=" color: red;">{{ $tag->title }}</span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/oreho" title="Admin home page">Home</a></li> &nbsp;&nbsp;
                        <li><a href="{{ route('tags.index') }}">List tags</li></a> &nbsp;&nbsp;
                        <li class="active">Edit tag &nbsp;&nbsp;&nbsp;<span style=" color: red;">
                                {{ $tag->title }}</span></li>
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
                    <form id="tag" name="tag" action="{{ route('tags.update', ['tag' => $tag->id]) }}"
                        method="POST" data-toggle="validator">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="title">Name tag</label>
                                <input type="text" name="title" class="form-control" id="title"
                                    placeholder="Name tag" value="{{ $tag->title }}" required>
                                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
                            </div>

                        </div>
                        <div class="box-footer">
                            <input type="hidden" name="id" value="{{ $tag->id }}">
                            <button type="submit" class="btn btn-default">EDIT</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    {{-- </div> --}}
    <!-- /.content -->
@endsection
