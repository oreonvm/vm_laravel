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
                    <h1 class="m-0">Edit user &nbsp;&nbsp;&nbsp;<span style=" color: red;">{{ $user->name }}</span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/oreho" title="Admin home page">Home</a></li> &nbsp;&nbsp;
                        <li><a href="{{ route('users.index') }}">List users</li></a> &nbsp;&nbsp;
                        <li class="active">Edit user &nbsp;&nbsp;&nbsp;<span style=" color: red;">
                                {{ $user->name }}</span></li>
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
                    <form id="user" name="user" action="{{ route('users.update', ['user' => $user->id]) }}"
                        method="POST" data-toggle="validator">
                        @csrf
                        @method('PUT')
                        <div class="box-body">
                            <div class="form-group has-feedback">
                                <label for="name">{{ $user->name }}</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="name" id="name"
                                    class="form-control" placeholder="Full name" autocomplete="name"
                                    value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group has-feedback">
                                <label for="email">Email</label>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="email" name="email" id="email"
                                    class="form-control" placeholder="E-mail *" autocomplete="off"
                                    value="{{ old('email') }}" class="@error('email') is-invalid @enderror">
                                @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group has-feedback">
                                <label for="avatar">Avatar</label>
                                @if (!@empty($user->avatar))
                                    <img src="{{ asset('storage/' . $user->avatar) }}" width="200" alt="">
                                @endif
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="avatar" id="avatar"
                                    class="form-control-file">
                                {{-- class="@error('avatar') is-invalid @enderror" --}}
                                {{-- @error('avatar')
                                    <div class="alert alert-danger">{{ $message = 'The avatar field must be an image.' }}</div>
                                @enderror --}}
                            </div>
                            <div class="box-footer">
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                <button type="submit" name="store" id="create" class="btn btn-default">EDIT</button>
                            </div>
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
