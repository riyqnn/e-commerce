<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\user;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Products;
use App\Models\MultiImg;

use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index () 
    {
        $sliders = Slider::where('status',1)->limit(3)->get();
        $categories = Category::orderBy('category_name_en','ASC')->get();
        $products = Products::where('status',1)->orderBy('id','DESC')->limit(6)->get();
        $featured = Products::where('featured',1)->orderBy('id','DESC')->limit(6)->get();
        $hotDeals = Products::where('hot_deals',1)->orderBy('id','DESC')->limit(3)->get();
        $specialOffer = Products::where('special_offer',1)->orderBy('id','DESC')->limit(3)->get();
        return view('frontend.index', compact('categories','sliders','products','featured','hotDeals','specialOffer'));
    }

    public function detail($id,$slug)
    {
        $product = Products::findOrFail($id);
        $multiImg = MultiImg::where('product_id', $id)->get();
        return view ('frontend.product.detail_product', compact('product','multiImg'));

    }

    public function userLogout ()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfileEdit ()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('profile.user_profile',compact('user'));
    }

    public function userProfileUpdate (Request $request)
    {
        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if($request->file('profile_photo_path')) {
            $file = $request->file('profile_photo_path');
            @unlink(public_path('upload/user_image'.$data->prfoile_photo_path));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_image'),$filename);
            $data['profile_photo_path'] = $filename;
        }

        $data->save();

        $notification = array(
            'message'=> 'Data User Berhasil Diupdate',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function changePassword ()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view ('profile.change_password',compact('user'));
    }

    public function userUpdatePassword (Request $request)
    {
        $validation = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hasPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hasPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        } else {
            return redirect()->back();
        }
    }
}
