{{-- <div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div> --}}
{{-- <div class="container"> --}}
@if (Session::has('status'))
    <div class="alert alert-success">
        {{ Session::get('success', 'Message send successfully!!!') }}
    </div>
@endif
{{-- </div> --}}
