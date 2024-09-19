<?php

namespace App\Http\Controllers;

use App\Models\Hr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HrController extends Controller
{
    //
    public function hr_edit($id)
    {
        $hr = Hr::find($id);

        return view('hr.profile.hr_edit', ['hr' => $hr]);
    }
    // updateHr
    public function updateHr(Request $request, $id)
    {

        try {

            $user = Hr::find($id);
            $admin = Auth::user(); // Assuming you're using Laravel's built-in authentication
            if ($admin->id !== $user->id) {
                return redirect('/login');
            }


            $formFields = $request->validate([
                'name' => 'required',
                'title' => 'nullable',
                'staff_number' => 'nullable',
                'email' => ['required', 'email'],
                'dob' => 'nullable',
                'phone' => 'required',

                'nin' => 'nullable',
                'tin' => 'nullable',
                'staff_number' => 'nullable',


            ]);


            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }
            // Hash password
            // $formFields['password'] = bcrypt($formFields['password']);




            Hr::where('id', $id)->update($formFields);


            return redirect()->route('hrProfilePage', $id)->with('success', 'Hr update successfully');
        } catch (\Exception $e) {
            // Catch any other exceptions and return a generic error response
            // return $e;

            return redirect()->back()->with('danger', "some thing wen't wrong try again");
        }
    }



    public function editPasswordHr(Request $request, $id)
    {
        $user = Hr::find($id);

        // Validate the request data
        $request->validate([
            'current_pwd' => 'required',
            'new_pwd' => 'required',
            'confirm_pwd' => 'required|same:new_pwd',
        ]);

        $data = $request->all();

        // Check if the current password provided matches the authenticated user's password
        if (Hash::check($data['current_pwd'], $user->password)) {
            // Check if the new password and confirm password match
            if ($data['new_pwd'] == $data['confirm_pwd']) {
                // Update the user's password
                $user->update(['password' => bcrypt($data['new_pwd'])]);
                return redirect()->route('hrProfilePage', $id)->with('success', 'Your password has been changed successfully.');
            } else {
                return redirect()->back()->with('danger', 'New password and confirm password do not match. Please retype the password.');
            }
        } else {
            return redirect()->back()->with('danger', 'Current password is incorrect.');
        }
    }
}
