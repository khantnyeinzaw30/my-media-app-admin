@extends('admin.layout.app')

@section('content')
    <div class="col-12">
        @if (Session::has('deleted'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>{{ Session::get('deleted') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">User Table</h3>
                <div class="card-tools">
                    <form action="{{ route('admin.list') }}" method="get">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right"
                                value="{{ request('table_search') }}" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                @if (count($admins))
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Address</th>
                                <th>Gender</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td>{{ $admin->address }}</td>
                                    <td>
                                        @if ($admin->gender == 'm')
                                            Male
                                        @elseif ($admin->gender == 'f')
                                            Female
                                        @endif
                                    </td>
                                    @if (Auth::user()->id != $admin->id)
                                        <td>
                                            <a href="{{ route('admin.deleteAccount', $admin->id) }}">
                                                <button class="btn btn-sm bg-danger text-white">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </a>
                                        </td>
                                    @endif
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning m-3" role="alert">
                        <h4 class="alert-heading">Can't found anything</h4>
                        <p> Search something else! </p>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
