@extends('admin.layout.app')

@section('content')
    <div class="mb-2">
        <a href="{{ route('posts.list') }}" class="btn btn-dark">
            <i class="fas fa-backward"></i>
        </a>
    </div>
    <div class="row">
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid">
        </div>
        <div class="card col-md-7">
            <div class="card-header p-2">
                <legend class="text-center">Edit your post..</legend>
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
                        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Title</label>
                                <div class="col-sm-9">
                                    <input type="text" name="title" value="{{ old('title', $post->title) }}"
                                        class="form-control @error('title') is-invalid @enderror" placeholder="Title">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" cols="30"
                                        rows="10" placeholder="Description">{{ old('description', $post->description) }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Category</label>
                                <div class="col-sm-9">
                                    <select name="category_id" class="form-control">
                                        <option value="">Choose category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $post->category_id ? 'selected' : '' }}>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Change Photo</label>
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
@endsection
