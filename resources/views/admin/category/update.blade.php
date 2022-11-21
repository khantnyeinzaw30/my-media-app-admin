@extends('admin.layout.app')

@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="mb-2">
                <a href="{{ route('category.list') }}" class="btn btn-dark">
                    <i class="fas fa-backward"></i>
                </a>
            </div>
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Edit your category..</legend>
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
                            <form action="{{ route('category.update', $category->id) }}" method="POST"
                                class="form-horizontal">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                                            class="form-control @error('name') is-invalid @enderror" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Description</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="description"
                                            value="{{ old('description', $category->description) }}"
                                            class="form-control @error('description') is-invalid @enderror"
                                            placeholder="Description">
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
    </div>
@endsection
