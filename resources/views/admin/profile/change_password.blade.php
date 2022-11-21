@extends('admin.layout.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change password</legend>
                </div>
                @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('notStrong'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('notStrong') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form action="{{ route('admin.changePassword', Auth::user()->id) }}" method="POST"
                                class="form-horizontal">
                                @csrf
                                <!-- Old password -->
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Old Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="old_password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            placeholder="Old Password">
                                    </div>
                                </div>
                                @error('old_password')
                                    <div class="alert alert-danger col-sm-8 offset-4">{{ $message }}</div>
                                @enderror
                                <!-- New password -->
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="new_password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            placeholder="New Password">
                                    </div>
                                </div>
                                @error('new_password')
                                    <div class="alert alert-danger col-sm-8 offset-4">{{ $message }}</div>
                                @enderror
                                <!-- Confirm new password -->
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Password Confirmation</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            placeholder="Confirm your new password">
                                    </div>
                                </div>
                                @error('password_confirmation')
                                    <div class="alert alert-danger col-sm-8 offset-4">{{ $message }}</div>
                                @enderror
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-8">
                                        <button type="submit" class="btn bg-dark text-white">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
