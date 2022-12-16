@extends('admin.layout.app')
@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Trend Post</h3>

                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                        <div class="input-group-append">
                            <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Post Title</th>
                            <th>Post Image</th>
                            <th>View Count</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $p)
                            <tr>
                                <td>{{ $p->post_id }}</td>
                                <td>{{ $p->title }}</td>
                                <td class=" col-2">
                                    @if ($p->image == null)
                                        <img src="{{ asset('defaultImage/business-3d-businessman-facepalming-over-a-page-not-found-error.png') }}"
                                            class=" w-75 shadow-sm" alt="">
                                    @else
                                        <img src="{{ asset('storage/' . $p->image) }}" class=" w-75 shadow-sm"
                                            alt="">
                                    @endif
                                </td>
                                </td>
                                <td><i class="fa-solid fa-eye"></i>{{ $p->post_count }}</td>
                                <td>
                                    <a href="{{ route('admin#trendPostDetails', $p->post_id) }}"
                                        class="btn btn-sm bg-dark text-white"><i class="fa-solid fa-file-lines"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class=" my-2">
                {{-- {{ $post->links() }} --}}
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
