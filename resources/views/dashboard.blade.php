@extends('frontend.main_master')

@section('content')

<div class="body-content">
    <div class="container">
        <div class="row ">
            <div class="col-md-2">
                <br>
                <img class="card-img-top mb-3" style="border-radius: 50%" src="{{(!empty($user->profile_photo_path))? url('upload/user_image/'.$user->profile_photo_path):url('upload/no_image.jpg')}}" height="100px" width="100%px">

                <li class="list-group list-group-flush">
                    <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('user.profile.edit')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </li>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hello </span><strong>{{Auth::user()->name  }}</strong> Welcome To Black Market</h3>
            </div>
        </div>
    </div>
</div>

@endsection