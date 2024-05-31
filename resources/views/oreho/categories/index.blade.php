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
                    <h1 class="m-0">List of categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/oreho" title="Admin home page">Home</a></li>&nbsp;&nbsp;
                        <li class="active">List of categories</li>
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
                        {{-- ==============>>  Output errors and warnings  ===================== --}}
                        <div class="col-9">
                            @if (session()->has('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>
                        {{-- ==================== End  block  error  ============================ --}}
                        <div class="table-responsive">
                            <a href="{{ route('categories.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;Add category</a>
                        </div>
                        @if (!@empty($categories) && count($categories))
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Slug</th>
                                            <th>Created_at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($categories as $category)
                                            <tr>
                                                <td>{{ $category->id }}</td>
                                                <td>{{ $category->title }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->created_at }}</td>
                                                <td>
                                                    <a class="edit"
                                                        href="{{ route('categories.edit', ['category' => $category->id]) }}">
                                                        <i class="fa fa-pencil-alt"></i></a>&nbsp;&nbsp;
                                                    <form id="category" name="category"
                                                        action="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                        method="POST" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $category->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirm delete!')">
                                                            <i style="margin-left: 4px;"
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                    {{-- <a href="{{ route('categories.destroy', ['category' => $category->id]) }}"
                                                            class="delete text-danger">
                                                            <i style="margin-left: 4px;" class="fas fa-trash-alt"></i></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="not_elements"> Categories while not yet...</div>
                        @endif
                        {{ $categories->onEachSide(2)->links('vendor.pagination.my_pagination') }}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </section>
    {{-- </div> --}}
    <!-- /.content -->

@endsection
