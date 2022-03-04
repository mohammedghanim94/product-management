<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Library\ValidationHelpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Throwable;

class UserController extends Controller
{

    use ValidationHelpers;

    /** Loads page to list all users */
    public function ListUsers()
    {
        $users = User::latest()->paginate(10);
        return view('users.view_user', compact('users'));
    }

    /** Loads page to add a new user */
    public function AddUser()
    {
        return view('users.add_user');
    }

    /** Stores new users data in db */
    public function StoreUser(Request $request)
    {

        try {

            $validatedData = $request->validate([
                'email' => 'required|unique:users',
                'name' => 'required'
            ]);

            $user = new User();
            $user->usertype = $request->usertype;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();
            
        } catch (Throwable $e) {

            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            report($e);

            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'User was added successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('users.list')->with($notification);
    }

    /** Loads page to edit user */
    public function EditUser($id)
    {
        $user = User::find($id);
        return view('users.edit_user', compact('user'));
    }

    /** Stores updated user data into db */
    public function UpdateUser(Request $request, $id)
    {

        try {

            $user = User::find($id);
            $user->usertype = $request->usertype;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
        } catch (Throwable $e) {

            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            report($e);

            return redirect()->back()->with($notification);
        }



        $notification = array(
            'message' => 'User was updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('users.list')->with($notification);
    }

    /** Deletes user from db */
    public function DeleteUser($id)
    {

        try {

            User::find($id)->delete();
        } catch (Throwable $e) {

            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );

            report($e);

            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message' => 'User was deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('users.list')->with($notification);
    }
}
