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
                    <a href="" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </li>
            </div>
            <div class="col-md-2">

            </div>
            <div class="col-md-6">
                <div class="card">
                    <h3 class="text-center"><span class="text-danger">Change Password</span></h3>


                    <form method="post" action="{{ route('user.update.password')}}">
                    @csrf
                        <div class="form-group">
                            <label class="info-title" for="current_password">Current Password <span>*</span></label>
                            <input type="password" id="current_password" name="oldpassword" class="form-control unicase-form-control text-input">
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password">New Password <span>*</span></label>
                            <input type="password" id="password" name="password" class="form-control unicase-form-control text-input">
                        </div>

                        <div class="form-group">
                            <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control unicase-form-control text-input">
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