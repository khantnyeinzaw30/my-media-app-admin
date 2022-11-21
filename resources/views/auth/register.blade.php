@extends('auth.layout.app')

@section('content')
    <form action="{{ route('register') }}" method="post">
        @csrf
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control @error('name') @enderror" placeholder="Enter Your Name">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') @enderror"
                placeholder="Enter Your Email">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') @enderror"
                placeholder="Enter Your Password">
        </div>
        <div class="mb-3">
            <label class="form-label">Password Confirmation</label>
            <input type="password" name="password_confirmation"
                class="form-control @error('password_confirmation') @enderror" placeholder="Confirm Your Password">
        </div>
        <div class="mb-2 text-end">
            <button class="btn btn-success px-3" type="submit">Register</button>
        </div>
    </form>

    <p class="text-dark">Have an account? <a href="{{ route('auth.login') }}">Login</a> here.</p>
@endsection
