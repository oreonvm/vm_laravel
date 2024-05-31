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
    <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <h1 class="title_product">Signup</h1>
            <form id="register" name="register" action="{{ route('register.store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                {{-- @method('post') --}}
                <div id="note"></div>
                <div class="form-group has-feedback">
                    <label for="name">Full name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Full name *"
                        autocomplete="given-name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror">
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="form-group has-feedback">
                        <label for="last_name">Last name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name *"
                            autocomplete="family-name" value="{{ old('last_name') }}" class="@error('last_name') is-invalid @enderror">
                        @error('last_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div> --}}
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
                    <label for="password">Password</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password" id="password"
                        class="form-control" placeholder="Password *" autocomplete="off"
                        class="@error('password') is-invalid @enderror">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group has-feedback">
                    <label for="password_confirmation">Confirm Password</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="password_confirmation"
                        id="password_confirmation" class="form-control" placeholder="Confirm Password *" autocomplete="off"
                        class="@error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group has-feedback">
                    <label for="avatar">Avatar</label>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="avatar" id="avatar"
                        class="form-control-file" placeholder="Choose image" class="@error('avatar') is-invalid @enderror">
                    @error('avatar')
                        <div class="alert alert-danger">{{ $message = 'The avatar field must be an image.' }}</div>
                    @enderror
                </div>

                <button type="submit" name="register" id="create"
                    style="font-size:10px; width: 25%;">Registration</button>
                <!-- </div> -->
            </form>

        </div>
        {{-- <div id="sidebar" class="col-xs-12 col-md-4">
            <h1 class="title">ПРАВАЯ ЧАСТЬ - ПОСТЫ users</h1>
            @foreach ($posts as $post)
                <div class="block_post">
                    <h4 class="name_post">{{ $post->title }}</h4>
                    <p class="post"> <a href="{{ route('post', $post->id) }}" target="_blank" rel="noopener noreferrer">
                            @php
                                $post->content = strip_tags($post->content);
                                $post->content = substr($post->content, 0, 60);
                                $post->content = rtrim($post->content, '!,.-');
                                $post->content = substr($post->content, 0, strrpos($post->content, ' '));
                                echo $post->content .
                                    '<span style="color: blue; font-weight:600;">&nbsp;&nbsp;(Подробнее)</span> ';
                            @endphp</a> </p>
                    <span class="date"> {{ $post->getPostDate() }}</span>
                </div>
            @endforeach
            {{ $posts->onEachSide(2)->links('vendor.pagination.my_pagination') }}
        </div> --}}
    </div>
@endsection
