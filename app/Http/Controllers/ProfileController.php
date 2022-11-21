<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    // direct admin profile page
    public function index()
    {
        $user = User::select('id', 'name', 'email', 'phone', 'address', 'gender')
            ->where('id', Auth::user()->id)
            ->first();
        return view('admin.profile.index', compact('user'));
    }

    // edit admin profile
    public function editProfile(Request $request)
    {
        $validator = $this->validateRequest($request);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $this->getDataFromRequest($request);
        User::where('id', Auth::user()->id)->update($data);
        return back()->with(['success' => 'Your account info have been updated.']);
    }

    // password change page
    public function changePasswordPage()
    {
        return view('admin.profile.change_password');
    }

    // change password in database
    public function changePassword($id, Request $request)
    {
        $this->validatePassword($request);
        $oldPassword = User::where('id', $id)->pluck('password')->first();
        if (Hash::check($request->old_password, $oldPassword)) {
            if ($this->regexCheck($request->new_password)) {
                User::where('id', $id)->update([
                    'password' => Hash::make($request->new_password)
                ]);
                return redirect()->route('admin.profile')->with(['passwordUpdated' => 'Password was updated!']);
            } else {
                return back()->with(['notStrong' => 'Your provided password is not strong enough!']);
            }
        } else {
            return back()->with(['error' => 'The credentials do not match!']);
        }
    }

    // change data format
    private function getDataFromRequest($request)
    {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'gender' => $request->gender
        ];
    }

    // validate request
    private function validateRequest($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|email|string',
        ]);
    }

    // check if new password is strong enough
    private function regexCheck($new_password)
    {
        if (preg_match('/[0-9]/', $new_password) && preg_match('/[a-z]/', $new_password) && preg_match('/[A-Z]/', $new_password)) {
            return true;
        }
        return false;
    }

    // validate password input
    private function validatePassword($request)
    {
        Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8|different:old_password',
            'password_confirmation' => 'required|same:new_password'
        ])->validate();
    }
}
