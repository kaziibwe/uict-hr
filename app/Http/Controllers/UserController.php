<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Staff;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class UserController extends Controller
{
    //

    //
    public function _construct()
    {
        $this->middleware('auth:admin-api', ['except' => ['adminlogin', 'adminregister']]);
    }

    public function registerUser(Request $request)
    {

        // return $request->all();
            $formFields = $request->validate([
                'department_id' => 'nullable|exists:departments,id',
                'name' => 'required',
                'title' => 'nullable',
                'department_id' => 'nullable|exists:departments,id',
                'name' => 'required',
                'title' => 'nullable',
                'staff_number' => 'nullable',
                'email' => ['required', 'email', Rule::unique('users', 'email')],
                'dob' => 'required',
                'phone' => 'required',
                'current_appointment' => 'nullable',
                'appointment_date' => 'nullable',
                'nin' => 'nullable',
                'tin' => 'nullable',
                'staff_number' => 'nullable',

                'date_appointed' => 'nullable',
                'salary_scale' => 'nullable',
                'salary_amount' => 'nullable',
                'allowances' => 'nullable',
                'gross_pay' => 'nullable',
                'education' => 'nullable',
                'netpay' => 'nullable',
                'duty' => 'nullable',
                'first_appointment' => 'nullable',
                'date_first_appointment' => 'nullable',
                'appointment_status' => 'nullable',
                'image' => 'nullable',
                'password' => 'required',

            ]);
            // return 'yes';
            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }
            // Hash password
            $formFields['password'] = bcrypt($formFields['password']);

            // return $formFields;
            try {

            User::create($formFields);

            return redirect()->route('manage_staff')->with('success', 'Staff created successfully');

        }  catch (\Exception $e) {
            // Catch any other exceptions and return a generic error response
           return  $e->getMessage();
            return redirect()->back()->with('danger', "some thing wen't wrong try again");
        }
    }



    public function updateUser(Request $request, $id)
    {

        try {

            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Staff Not Found'], 401);
            }

            $formFields = $request->validate([
                'department_id' => 'nullable|exists:departments,id',
                'name' => 'required',
                'title' => 'nullable',
                'department_id' => 'nullable|exists:departments,id',
                'name' => 'required',
                'title' => 'nullable',
                'staff_number' => 'nullable',
                'email' => ['required', 'email'],
                'dob' => 'required',
                'phone' => 'required',
                'current_appointment' => 'nullable',
                'appointment_date' => 'nullable',
                'nin' => 'nullable',
                'tin' => 'nullable',
                'staff_number' => 'nullable',

                'date_appointed' => 'nullable',
                'salary_scale' => 'nullable',
                'salary_amount' => 'nullable',
                'allowances' => 'nullable',
                'gross_pay' => 'nullable',
                'education' => 'nullable',
                'netpay' => 'nullable',
                'duty' => 'nullable',
                'first_appointment' => 'nullable',
                'date_first_appointment' => 'nullable',
                'appointment_status' => 'nullable',
            ]);


            if ($request->hasFile('image')) {
                $formFields['image'] = $request->file('image')->store('images', 'public');
            }
            // Hash password
            // $formFields['password'] = bcrypt($formFields['password']);

            $admin = User::where('id', $id)->update($formFields);

            if ($admin) {
                return response()->json(["Admin" => $admin, 'status' => true], 200);
            } else {
                return response()->json(['status' => false], 500);
            }
        } catch (ValidationException $e) {
            // Return JSON response with validation errors
            return response()->json([
                'errors' => $e->errors(), // Detailed validation errors
            ], 422);
        } catch (\Exception $e) {
            // Catch any other exceptions and return a generic error response
            return response()->json([
                'error' => $e->getMessage(), // Detailed error message
            ], 500);
        }
    }



    public function changePasswordUser(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Staff Not Found'], 401);
        }

        $data = $request->all();

        if (Hash::check($data['current_pwd'], $user->password)) {
            $user->update(['password' => bcrypt($data['new_pwd'])]);
            return response()->json(["message" => "Password changed successfully", 'status' => true], 200);
        } else {
            return response()->json(['message' => 'Current password is incorrect.'], 400);
        }
    }


    public function loginUser(Request $request)
    {
        $credentials = request(['email', 'password']);
        // return $credentials;
        if (!$token = auth()->guard('user-api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized Staff'], 401);
        }
        return $this->respondWithToken($token);
    }


    protected function respondWithToken($token)
    {
        // $user = auth()->guard('admin-api')->user();
        $user = auth()->guard('user-api')->user();
        $userData = $user->only('id', 'email', 'name', 'title', 'dob', 'nin', 'tin', 'staff_number', 'phone');

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('user-api')->factory()->getTTL() * 60,
            'user' => $userData


        ]);
    }



    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'message' => 'User not find'
            ], 401);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }





    // protected function respondWithToken($token)
    // {
    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => Auth::guard('admin-api')->factory()->getTTL() * 60
    //     ]);
    // }

    public function profileAdmin()
    {
        return response()->json(auth()->guard('admin-api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutUser()
    {
        auth()->guard('user-api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }



    // public function getAllUser(){
    //  $users =   User::all();
    //  return response()->json(['users'=>$users]);
    // }



    public function getAllUser(Request $request)
    {
        // $users =   User::all();
        // return response()->json(['users' => $users]);
        try {
            $perPage = $request->query('perPage', 10); // Number of items per page
            $page = $request->query('page', 1); // Current page number
            $users = User::paginate($perPage, ['*'], 'page', $page);

            return response()->json([
                'results' => [
                    'data' => $users->items(),
                    'total' => $users->total(),
                    'per_page' => $users->perPage(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'first_page_url' => $users->url(1),
                    'last_page_url' => $users->url($users->lastPage()),
                    'next_page_url' => $users->nextPageUrl(),
                    'prev_page_url' => $users->previousPageUrl(),
                    'path' => $users->path(),
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to fetch users',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function getSingleUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User Not Found'], 422);
        }
        return response()->json(['user' => $user]);
    }



    public function getAllAdmin()
    {
        $Admins =   Admin::all();
        return response()->json(['Admins' => $Admins], 200);
    }

    public function getSingleAdmin($id)
    {
        $Admin = Admin::find($id);
        if (!$Admin) {
            return response()->json(['message' => 'Admin Not Found'], 401);
        }
        return response()->json(['Admin' => $Admin], 200);
    }




    // check network
    public function checkNetworkId( Request $request)
    {

        try{
        $formFields=$request->validate([
           'network_id'=>'required',
        //    'ip_address'=>'required'

        ]);
        $network_id=$request->input('network_id');

        // $ip_address=$request->input('ip_address');

        // $network='a4:00:e2:ef:ce:20';
        // // $network='a0:36:78:c6:13:62';

        $network=Setting::find(1);

        $network_sensor = $network->sensor;
        // return $network_sensor;

        if($network_id==$network_sensor){
            return response()->json([
                "message"=>"valid network"
            ],200);
        }else{
            return response()->json([
                "message"=>"invalid network"
            ],401);
        }
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'something thing went wrong try again',
        ], 500);
    }

    }

}
