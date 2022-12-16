@extends('admin.layout.app')
@section('content')
    <div class="col-6 offset-3 mt-5">
        <!-- /.card -->
        <a href="{{ route('admin#trendPost') }}" class=" text-dark"><i class=" fa-solid fa-arrow-left"></i> Back</a>
        <div class="card">
            <div class=" card-header text-center">
                @if ($post->image == null)
                    <img src="{{ asset('defaultImage/business-3d-businessman-facepalming-over-a-page-not-found-error.png') }}"
                        class=" w-50 shadow-sm" alt="">
                @else
                    <img src="{{ asset('storage/' . $post->image) }}" class=" w-50 shadow-sm" alt="">
                @endif
            </div>
            <div class=" card-body">
                <h3 class=" text-center">{{ $post->title }}</h3>
                <p>{{ $post->description }}</p>
            </div>
        </div>
    </div>
@endsection
