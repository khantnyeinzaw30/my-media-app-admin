@extends('admin.layout.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
                </div>
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (Session::has('passwordUpdated'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('passwordUpdated') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form action="{{ route('admin.editProfile') }}" method="POST" class="form-horizontal">
                                @csrf
                                <!-- Admin Name -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                            class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                    </div>
                                </div>
                                @error('name')
                                    <div class="alert alert-danger col-sm-10 offset-2">{{ $message }}</div>
                                @enderror
                                <!-- Email -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                            class="form-control @error('email') is-invalid @enderror" placeholder="Email">
                                    </div>
                                </div>
                                @error('email')
                                    <div class="alert alert-danger col-sm-10 offset-2">{{ $message }}</div>
                                @enderror
                                <!-- Phone number -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Phone</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="phone" value="{{ old('phone', $user->phone) }}"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="Phone Number">
                                    </div>
                                </div>
                                <!-- Address -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" cols="30" rows="5"
                                            placeholder="Address">{{ old('address', $user->address) }}</textarea>
                                    </div>
                                </div>
                                <!-- Gender -->
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        @if ($user->gender != null)
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose Your Gender</option>
                                                <option value="m" {{ $user->gender == 'm' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="f" {{ $user->gender == 'f' ? 'selected' : '' }}>Female
                                                </option>
                                            </select>
                                        @else
                                            <select name="gender"
                                                class="form-control @error('gender') is-invalid @enderror">
                                                <option value="">Choose Your Gender</option>
                                                <option value="m">Male</option>
                                                <option value="f">Female</option>
                                            </select>
                                        @endif
                                    </div>
                                </div>
                                <!-- go to change password route -->
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <a href="{{ route('admin.changePasswordPage') }}">Change Password</a>
                                    </div>
                                </div>
                                <!-- submit -->
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
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
