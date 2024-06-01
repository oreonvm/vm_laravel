@extends('layouts.main')
@extends('layouts.footer')

@section('content')
    <nav id="top">
        <label for="drop" class="toggle"><img src="/images/menu-48.png" width="38" alt=""> Menu</label>
        <input type="checkbox" id="drop">
        <ul class="menu">
            {!! $menu !!}
        </ul>
    </nav>
    <div class="container">
        @include('layouts.alerts')
        <div class="post_show">
            <div class="col-xs-12 col-sm-12 col-md-8">
                @if (!$user)
                    <div class="alert alert-danger">{{ $message = 'Please log in before sending a message!' }}
                    </div>
                @endif
                <h1 class="title_product">Contact us</h1>
                <form id="contact" name="contact" action="{{ route('contact.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="note"></div>
                    <div class="form-group has-feedback">
                        <label for="first_name">First name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control"
                            placeholder="First name *" autocomplete="given-name" value="{{ old('first_name') }}"
                            class="@error('first_name') is-invalid @enderror">
                        @error('first_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <label for="last_name">Last name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name *"
                            autocomplete="family-name" value="{{ old('last_name') }}"
                            class="@error('last_name') is-invalid @enderror">
                        @error('last_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
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
                        <label for="subject">Subject</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="subject" id="subject" class="form-control"
                            placeholder="Subject" autocomplete="subject" value="{{ old('subject') }}"
                            class="@error('subject') is-invalid @enderror">
                        @error('subject')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <textarea name="message" class="form-control" cols="10" rows="10" id="comment" placeholder="message"
                            value="{{ old('message') }}" class="@error('message') is-invalid @enderror"></textarea>
                        @error('message')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group has-feedback">
                        <label for="image">Screenshot</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="image" id="image"
                            class="form-control-file" value="" placeholder="Choose image"
                            class="@error('image') is-invalid @enderror">
                        @error('image')
                            <div class="alert alert-danger">{{ $message = 'The image field must be an image.' }}</div>
                        @enderror
                    </div>
                    @if (!$user)
                        <button type="submit" name="contact" id="submit_contact" disabled>Send</button>
                    @else
                        <button type="submit" name="contact" id="submit_contact">Send</button>
                    @endif
                    <!-- </div> -->
                </form>
            </div>
            @include('home.sidebar')
        </div>
    </div>
@endsection
