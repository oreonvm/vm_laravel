<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List posts</title>
</head>

<body>

    @foreach ($posts as $post)
        {{ $post->title }} = {{ $post->content }} <br>
    @endforeach


    <div>Create post:
        <a href="{{ route('posts.create', ['post' => '?']) }}">Create post</a>
    </div>
    <ul>
       
        {{-- &nbsp; &nbsp; &nbsp;<a href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit Post</a></li>
       
   
       
        &nbsp; &nbsp; &nbsp;<a href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit Post</a></li>
        
       
        &nbsp; &nbsp; &nbsp;<a href="{{ route('posts.edit', ['post' => $post->id]) }}">Edit Post</a></li>
         --}}


</body>

</html>
