@extends('admin.layout.app')
@section('content')
    <div class="col-lg-4">
        <div class="card my-3">
            <div class="card-body">
                <form action="{{ route('admin#updateCategory', $updateData->category_id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="categoryName" class="form-control" id=""
                            placeholder="Enter Category Name" value="{{ old('categoryName', $updateData->title) }}">
                        @error('categoryName')
                            <p class=" text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="categoryDescription" class=" form-control" id="" cols="30" rows="10"
                            placeholder="Enter Description">{{ old('categoryDescription', $updateData->description) }}</textarea>
                        @error('categoryDescription')
                            <p class=" text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin#category') }}">
                        <button class=" btn btn-dark">Create</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8 my-3">
        @if (session('deleteSuccess'))
            <div class="">
                <div class="alert alert-danger alert-dismissible fade show col-5 offset-7" role="alert">
                    <strong>{{ session('deleteSuccess') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category Table</h3>

                <div class="card-tools">
                    <form action="{{ route('admin#categorySearch') }}" method="post">
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
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Category Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $item)
                            <tr style="background-color:@if ($updateData->category_id == $item->category_id) lightgrey @endif">
                                <td>{{ $item->category_id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="{{ route('admin#categoryEditPage', $item->category_id) }}">
                                        <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                                    </a>
                                    <a href="{{ route('admin#deleteCategory', $item->category_id) }}">
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
