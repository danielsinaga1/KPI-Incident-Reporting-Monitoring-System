<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Hash;
use App\User;
use App\Rules\MatchOldPassword;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{

    public function edit(User $user) {
        $user = Auth::user();

        return view('admin.profiles.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        // $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function index() {

        $user = auth()->user();

        return view('admin.profiles.index', compact('user'));
    }

    public function display($id) {
        $auth = Auth::user()->id;
        $users=\App\users::all()->whereNotIn('id',$auth);
        $tampilkan = Users::find($id);
     return view('tampilkan', compact('tampilkan', 'users')); 
    }
    
    
    // public function changePassword2(Request $request) {
        

    //     if(!(Hash::check($request->get('password'), Auth::user()->password))) {
    //         return redirect()->back()->with("error", "Your current Password does not matches with the password you provided. Please try again.");
    //     }

    //     if(strcmp($request->get('password'), $request->get('new_password')) == 0) {
    //         return redirect()->back()->with("error","New Password cannot be same as your current Password. Please choose a different password.");
    //     }

    //     $validatedData = $request->validate([
    //         'password' => 'required',
    //         'new_password' => 'required|string|min:6|confirmed',
    //         'new_confirm_password' => 'required',
    //     ]);

    //     //Change Password
    //     $user = auth()->user();
    //     $user->password = bcrypt($request->get('new_password'));
    //     $user->save();

    //     return redirect()->back()->with("success","Password changed successfully");
    // }

    public function updateAuthUserPassword(Request $request) {
        $this->validate($request, [
            'current' => 'required',
            'new_password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = User::find(Auth::id());

        if(!Hash::check($request->current, $user->password)) {
            return response()->json(['errors' => ['current'=> ['Current password does not match!']]],422);
        }

        $user->password = Hash::make($request-password);
        $user->save();

        return $user;
    }

    public function postChangePassword(ChangePasswordRequest $request) {
        if(Auth::check()) {
            if (Hash::check($request->current_password, Auth::user()->password)) {
                $user = User::find(Auth::user()->id)->update(["password" => bcrypt($request->new_password)]);
            } else {
                return redirect()->back()->with('alert-danger', 'Incorrect Details !');
            }
        }  
        return redirect()->back()->with('alert-success','Password changed successfully !');
    }
 
    public function changePassword(Request $request) {

        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required',
                                'min:6'],
            'password_confirmation' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back()->with("success","Password changed successfully !");
    }

    public function updatePassword(Request $request) {
        if(!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            //The password not matches
            return response()->json(['errors' => ['current'=> ['Current password does not match']]], 422);
        }
        if(strcmp($request->get('current_password'), $request->get('new_password')) == 0){
            //Current password and new password are same
            //return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
            return response()->json(['errors' => ['current'=> ['New Password cannot be same as your current password']]], 422);
        }

        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        return redirect()->back()->with("success","Password changed successfully !");
    }
}
