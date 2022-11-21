@extends('admin.layout.app')

@section('content')
    <div class="col-md-4">
        <div class="card">
            <div class="card-header p-2">
                <legend class="text-center">Create new category..</legend>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <form action="{{ route('category.create') }}" method="POST" class="form-horizontal">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30"
                                        rows="6" placeholder="Description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-3 col-sm-9">
                                    <button type="submit" class="btn bg-dark text-white">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        @if (Session::has('updated'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong class="text-uppercase">{{ Session::get('updated') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (Session::has('deleted'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong class="text-uppercase">{{ Session::get('deleted') }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List</h3>
                <div class="card-tools">
                    <form action="{{ route('category.list') }}" method="get">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            @csrf
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search"
                                value="{{ request('table_search') }}">
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
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Created Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <span class="font-weight-bold">{{ $category->name }}</span>
                                </td>
                                <td>{{ Str::words($category->description, 10, '...') }}</td>
                                <td>{{ $category->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('category.updatePage', $category->id) }}">
                                        <button class="btn btn-sm bg-dark text-white">
                                            <i class="fas fa-edit"></i>
                                        </button></a>
                                    <a href="{{ route('category.delete', $category->id) }}">
                                        <button class="btn btn-sm bg-danger text-white">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
