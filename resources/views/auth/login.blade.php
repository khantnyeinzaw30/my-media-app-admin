@extends('auth.layout.app')

@section('content')
    <form action="{{ route('login') }}" method="post">
        @csrf
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                placeholder="Enter Your Email">
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                placeholder="Enter Your Password">
        </div>
        <div class="mb-2 text-end">
            <button class="btn btn-success px-3" type="submit">Login</button>
        </div>
    </form>

    <p class="text-dark">Haven't have an account yet? <a href="{{ route('auth.register') }}">Register</a> here.</p>
@endsection
