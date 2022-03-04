<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Library\FilesHelpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Throwable;
use Image;

class ProfileController extends Controller
{   
    use FilesHelpers;
    /** Loads page to show logged in user profile */
    public function ViewProfile()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        return view('users.view_profile', compact('user'));
    }

    /** Loads page to edit logged in user profile */
    public function EditProfile()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        return view('users.edit_profile', compact('user'));
    }

    /** Store updated profile data into db */
    public function UpdateProfile(Request $request, $id)
    {

        try {

            $user = User::find($id);

            // uploads profile image and returns path and name
            if ($request->file('image')) {               
                $user->image = $this->UploadImage($request->file('image'),'upload/user_images/');
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->save();

            $notification = array(
                'message' => 'Profile updated successfully',
                'alert-type' => 'success'
            );

            return Redirect()->route('view.profile')->with($notification);

        } catch (Throwable $e) {
            
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            report($e);

            return Redirect()->back()->with($notification);
        }
    }

    /** Loads page to update user password */
    public function ChangePassword(){
        return view('users.changepassword');
    }

    /** Validates passwords and stores updated password into db */
    public function UpdatePassword(Request $request){

        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed'
        ]);

        $HashedPassword = Auth::user()->password;

        if(Hash::check($request->oldpassword,$HashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::guard('web')->logout();
            return Redirect()->route('login');
        }else{
            return Redirect()->back();
        }

    }
}
