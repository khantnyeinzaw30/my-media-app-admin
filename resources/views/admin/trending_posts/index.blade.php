@extends('admin.layout.app')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trending Posts</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Post Title</th>
                            <th>Photo</th>
                            <th>View Count</th>
                            <th>Published Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($trendingPosts as $i)
                            <tr>
                                <td>
                                    <span class="font-weight-bold">{{ Str::words($i->title, 4, '...') }}</span>
                                </td>
                                <td>
                                    <img src="{{ asset('storage/' . $i->image) }}" style="width: 100px"
                                        class="rounded img-fluid">
                                </td>
                                <td><i class="fas fa-eye mr-2"></i>{{ $i->post_count }}</td>
                                <td>{{ $i->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('posts.details', $i->post_id) }}">
                                        <button class="btn btn-sm bg-info text-white" style="padding: 4px 12px;"><i
                                                class="fas fa-info"></i></button>
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
