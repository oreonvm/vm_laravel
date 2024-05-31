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
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="list-unstyled">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-9">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead style="border: 1.5px solid black;text-align:center !important;">
                        <tr>
                            <th>id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>orders</th>
                            <th>Posts</th>
                            <th>Create Post</th>
                            <td>Edit post</td>
                        </tr>
                    </thead>
                    <tbody style="border: 1.5px solid black;text-align:center;">
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>--</td>
                            <td>
                                @php
                                    $posts = DB::table('posts')
                                        ->select('id', 'title', 'email')
                                        ->where('email', $user->email)
                                        ->get();
                                    // dump($posts);
                                    foreach ($posts as $post) {
                                        echo $post->title . '<br>';
                                    }
                                @endphp
                            </td>

                            <td>
                                @if (auth()->user()->id)
                                    <a
                                        href="{{ route('posts.create', ['post' => ['id' => 'id', 'email' => $user->email]]) }}">Create
                                        Post</a>
                                @endif

                            </td>
                            <td>
                                <?php
                                     foreach ($posts as $post){
                                    if(!empty($post->email) && $post->email === $user->email){ ?>
                                <a href="{{ route('posts.edit', $post->id) }}">Edit post
                                    {{ $post->id }}</a><br>
                                <?php  } else{
                                        null ;
                                         }
                                        }
                                ?>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    @endsection
