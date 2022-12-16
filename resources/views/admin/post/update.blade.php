@extends('admin.layout.app')
@section('content')
    <div class="col-lg-4">
        <div class="card my-3">
            <div class="card-body">
                <form action="{{ route('admin#postUpdate', $postDetail->post_id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Post Name</label>
                        <input type="text" name="postTitle" class="form-control" id=""
                            placeholder="Enter Post Title" value="{{ old('postTitle', $postDetail->title) }}">
                        @error('postTitle')
                            <p class=" text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Post Description</label>
                        <textarea name="postDescription" class=" form-control" id="" cols="30" rows="10"
                            placeholder="Enter Post Description">{{ old('postDescription', $postDetail->description) }}</textarea>
                        @error('postDescription')
                            <p class=" text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="img-box mb-2">
                            @if ($postDetail->image == null)
                                <img src="{{ asset('defaultImage/business-3d-businessman-facepalming-over-a-page-not-found-error.png') }}"
                                    class="w-100 img-thumbnail shadow" alt="">
                            @else
                                <img src="{{ asset('storage/' . $postDetail->image) }}" class=" w-100 img-thumbnail shadow"
                                    alt="">
                            @endif
                        </div>
                        <label for="">Image</label>
                        <input type="file" name="postImage" class=" form-control" id="">
                    </div>
                    <div class="form-group">
                        <select name="postCategory" id="" class=" form-control">
                            <option value="">Choose Category</option>
                            @foreach ($category as $item)
                                <option value="{{ $item->category_id }}" @if ($postDetail->category_id == $item->category_id) selected @endif>
                                    {{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('postCategory')
                            <p class=" text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin#post') }}">
                        <button class=" btn btn-dark">Create</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 my-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Post Table</h3>

                <div class="card-tools">
                    <form action="" method="post">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="categorySearchKey" class="form-control float-right"
                                placeholder="Search" value="{{ request('categorySearchKey') }}">

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
                            <th>Id</th>
                            <th>Post Title</th>
                            <th>Post Iamge</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $item)
                            <tr style="background-color: @if ($item->post_id == $postDetail->post_id) lightgrey @endif">
                                <td>{{ $item->post_id }}</td>
                                <td>{{ $item->title }}</td>
                                <td class=" col-2">
                                    @if ($item->image == null)
                                        <img src="{{ asset('defaultImage/business-3d-businessman-facepalming-over-a-page-not-found-error.png') }}"
                                            class=" w-75 shadow-sm" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $item->image) }}" class=" w-75 shadow-sm"
                                            alt="">
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin#postEditPage', $item->post_id) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#deletePost', $item->post_id) }}">
                                        <button class="btn btn-sm bg-danger text-white"><i
                                                class="fas fa-trash-alt"></i></button>
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
