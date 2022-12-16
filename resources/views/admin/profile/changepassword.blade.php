@extends('admin.layout.app')

@section('content')
    <div class="col-8 offset-3  mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <form class="form-horizontal" action="{{ route('admin#changePassword') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class=" col-sm-3 col-form-label">Old Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="inputName"
                                            placeholder="Enter Old Password..." name="oldPassword">
                                        @error('oldPassword')
                                            <p class=" text-danger">{{ $message }}</p>
                                        @enderror
                                        @if (session('notMatchError'))
                                            <p class=" text-danger">{{ session('notMatchError') }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class=" col-sm-3 col-form-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="inputEmail"
                                            placeholder="Enter New Password..." name="newPassword">
                                        @error('newPassword')
                                            <p class=" text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class=" col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id=""
                                            placeholder="Confirm Password..." name="confirmPassword">
                                        @error('confirmPassword')
                                            <p class=" text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class=" col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white">Change Password</button>
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
