@extends('admin.layout.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <a href="{{ route('posts.list') }}">
                        <button class="btn btn-sm btn-outline-dark">All posts</button>
                    </a>
                    <a href="{{ route('admin.trendingPosts') }}">
                        <button class="btn btn-sm btn-outline-dark">Trending</button>
                    </a>
                </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <img class="img-fluid col-4" style="border-radius: 20px;" src="{{ asset('storage/' . $post->image) }}">
                    <div class="col-8">
                        <h2 class="text-uppercase fw-bold">{{ $post->title }}</h2>
                        <p class="text-muted" style="letter-spacing: 1px;">{{ $post->description }}</p>
                        <button class="btn btn-primary">{{ $post->category_name }}</button>
                        <a href="{{ route('posts.updatePage', $post->id) }}" class="btn btn-success">
                            Edit infos <i class="fas fa-edit ml-2"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>
@endsection
