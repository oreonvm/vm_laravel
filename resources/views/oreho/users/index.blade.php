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
                    <h1 class="m-0">List of users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/oreho" title="Admin home page">Home</a></li>&nbsp;&nbsp;
                        <li class="active">List of users</li>
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
                        @if (!@empty($users) && count($users))
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Email_verified_at</th>
                                            <th>Created_at</th>
                                            <th>Is_admin</th>
                                            <th>Avatar</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($users as $user)
                                            <tr>
                                                <td align="center">{{ $user->id }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->email_verified_at }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td align="center">{{ $user->is_admin }}</td>
                                                <td>
                                                    @if (!@empty($user->avatar))
                                                        <img src="{{ asset('storage/' . $user->avatar) }}" width="100"
                                                            alt="">
                                                    @endif
                                                </td>
                                                <td>
                                                    {{-- <a class="edit"
                                                        href="{{ route('users.edit', ['user' => $user->id]) }}">
                                                        <i class="fa fa-pencil-alt"></i></a>&nbsp;&nbsp; --}}
                                                    <form id="user" name="user"
                                                        action="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                        method="POST" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                        <button type="submit" class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Confirm delete!')">
                                                            <i style="margin-left: 4px;"
                                                                class="fas fa-trash-alt"></i></button>
                                                    </form>
                                                    {{-- <a href="{{ route('users.destroy', ['user' => $user->id]) }}"
                                                            class="delete text-danger">
                                                            <i style="margin-left: 4px;" class="fas fa-trash-alt"></i></a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="not_elements"> Users while not yet!!...</div>
                        @endif
                        {{ $users->onEachSide(2)->links('vendor.pagination.my_pagination') }}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.row -->
    </section>
    {{-- </div> --}}
    <!-- /.content -->

@endsection
