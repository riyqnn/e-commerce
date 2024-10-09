@extends('frontend.main_master')

@section('content')

<div class="body-content">
    <div class="container">
        <div class="row ">
            <div class="col-md-2">
                <br>
                <img class="card-img-top mb-3" style="border-radius: 50%" src="{{(!empty($user->profile_photo_path))? url('upload/user_image/'.$user->profile_photo_path):url('upload/no_image.jpg')}}" height="100px" width="100%px">

                <li class="list-group list-group-flush">
                    <a href="{{ route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('user.profile.edit')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="{{ route('change.password')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </li>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Hello...</span><strong>{{Auth::user()->name  }}</strong> Edit profile</h3>


                    <form method="post" action="{{ route('user.profile.update')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label class="info-title" for="name">Name <span>*</span></label>
                            <input type="text" id="name" name="name" value="{{$user->name}}" class="form-control unicase-form-control text-input">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="email">Email <span>*</span></label>
                            <input type="email" id="email" name="email" value="{{$user->email}}" class="form-control unicase-form-control text-input">
                        </div>
                        <div class="form-group">
                            <label class="info-title" for="phone">Phone <span>*</span></label>
                            <input type="number" id="phone" name="phone" value="{{$user->phone}}" class="form-control unicase-form-control text-input">
                        </div>

                        <div class="form-group">
                            <label class="info-title">Profile photo <span>*</span></label>
                            <input type="file" name="profile_photo_path" class="form-control unicase-form-control text-input"> </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
                        </div>
                    </form>
               </div>
           </div>
        </div>
    </div>
</div>


@endsection