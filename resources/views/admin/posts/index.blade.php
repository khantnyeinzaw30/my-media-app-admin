@extends('admin.layout.app')

@section('content')
    <div class="col-sm-4">
        <div class="card">
            <div class="card-header p-2">
                <legend class="text-center">Create new post..</legend>
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
                        <form action="{{ route('posts.create') }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30"
                                        rows="10" placeholder="Description">{{ old('description') }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control">
                                        <option value="">Choose category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Add Photo</label>
                                <div class="col-sm-9">
                                    <input type="file" name="image"
                                        class="form-control-file @error('image') is-invalid @enderror">
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
    <div class="col-sm-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Post List
                </h3>
                <div class="card-tools">
                    <form action="{{ route('posts.list') }}" method="get">
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
                @if (count($posts) != null)
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>Post Title</th>
                                <th>Photo</th>
                                <th>Category</th>
                                <th>Published Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($posts as $post)
                                <tr>
                                    <td>
                                        <span class="font-weight-bold">{{ Str::words($post->title, 2, '...') }}</span>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $post->image) }}" class="rounded img-fluid">
                                    </td>
                                    <td>{{ $post->category_name }}</td>
                                    <td>{{ $post->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('posts.details', $post->id) }}">
                                            <button class="btn btn-sm bg-info text-white" style="padding: 4px 12px;"><i
                                                    class="fas fa-info"></i></button>
                                        </a>
                                        <a href="{{ route('posts.updatePage', $post->id) }}">
                                            <button class="btn btn-sm bg-dark text-white"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>
                                        <a href="{{ route('posts.delete', $post->id) }}">
                                            <button class="btn btn-sm bg-danger text-white"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning m-3" role="alert">
                        <h4 class="alert-heading">No matching posts here.</h4>
                        <p> Create Something so you can see here. </p>
                    </div>
                @endif
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
