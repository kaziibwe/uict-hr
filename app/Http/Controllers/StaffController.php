<?php

namespace App\Http\Controllers;

// use auth;
use App\Models\Hr;
use App\Models\User;
use App\Models\Admin;
use App\Models\Staff;
use App\Mail\Verifylogin;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class StaffController extends MainController

{





    public function manage_staff()
    {
        $model = new User();
        $view = 'hr.manage_staff.manage_staff';
        $route = 'manage_staff';

        return parent::read($model, $view, $route);
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


             User::where('id', $id)->update($formFields);


             return redirect()->route('manage_staff')->with('success', 'Staff updated successfully');

            }  catch (\Exception $e) {
                // Catch any other exceptions and return a generic error response

                return redirect()->back()->with('danger', "some thing wen't wrong try again");
            }
    }


    public function logout(Request $request)
    {
        Auth::guard('hr')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/hr/login')->with('success', 'logged out successfully !');
    }


    // public function createDepartment(StoreDepartmentRequest $request)
    // {
    //     $rules = $request->rules();
    //     $route = 'departments.index';
    //     $successMessage = 'Department created successfully!';

    //     return parent::store($request, new Department, $rules, $route, $successMessage);
    // }

    // public function index()
    // {
    //     $model = new Department;
    //     $view = 'departments.index';
    //     $errorMessage = 'Error fetching departments.';

    //     return parent::read($model, $view, $errorMessage);
    // }

    // public function show($id)
    // {
    //     $model = new Department;
    //     $view = 'departments.show';
    //     $errorMessage = 'Error fetching department details.';

    //     return parent::readSingle($model, $id, $view, $errorMessage);
    // }

    // public function edit($id)
    // {
    //     // Similar to show but return an edit view
    // }

    // public function updateDepartment(Request $request, $id)
    // {
    //     $rules = [
    //         'name' => 'required|string|max:255',
    //         'description' => 'required|string|max:1000',
    //     ];
    //     $route = 'departments.index';
    //     $successMessage = 'Department updated successfully!';

    //     return parent::update($request, new Department, $id, $rules, $route, $successMessage);
    // }

    // public function deleteDepartment($id)
    // {
    //     $route = 'departments.index';
    //     $successMessage = 'Department deleted successfully!';

    //     return parent::delete(new Department, $id, $route, $successMessage);
    // }





    //
    // public function _construct()
    // {
    //     $this->middleware('auth:admin-api', ['except' => ['adminlogin', 'adminregister']]);
    // }

    // public function createStaff(Request $request)
    // {

    //     try {


    //         $formFields = $request->validate([
    //             'department_id' => 'required|exists:departments,id',
    //             'name' => 'required',
    //             'title' => 'required',
    //             'staff_number' => 'required',
    //             'email' => ['required', 'email', Rule::unique('staff', 'email')],
    //             'dob' => 'required',
    //             'phone' => 'required',
    //             'current_appointment' => 'required',
    //             'appointment_date' => 'required',
    //             'nin' => 'required',
    //             'tin' => 'required',
    //             'staff_number' => 'required',
    //             'password' => 'required',
    //         ]);

    //         if ($request->hasFile('image')) {
    //             $formFields['image'] = $request->file('image')->store('images', 'public');
    //         }
    //         // Hash password
    //         $formFields['password'] = bcrypt($formFields['password']);

    //         $admin = Staff::create($formFields);

    //         if ($admin) {
    //             return response()->json(["Admin" => $admin, 'status' => true], 200);
    //         } else {
    //             return response()->json(['status' => false], 500);
    //         }
    //     } catch (ValidationException $e) {
    //         // Return JSON response with validation errors
    //         return response()->json([
    //             'errors' => $e->errors(), // Detailed validation errors
    //         ], 422);
    //     } catch (\Exception $e) {
    //         // Catch any other exceptions and return a generic error response
    //         return response()->json([
    //             'error' => $e->getMessage(), // Detailed error message
    //         ], 500);
    //     }
    // }




    // public function loginStaff(Request $request)
    // {
    //     $credentials = request(['email', 'password']);
    //     if (!$token = auth()->guard('staff-api')->attempt($credentials)) {
    //         return response()->json(['error' => 'Unauthorized User'], 401);
    //     }
    //     return $this->respondWithToken($token);
    // }


    // protected function respondWithToken($token)
    // {
    //     // $user = auth()->guard('admin-api')->user();
    //     $user = auth()->guard('admin-api')->user();
    //     $userData = $user->only('email', 'role', 'phone', 'name', 'location', 'sex',);

    //     return response()->json([
    //         'access_token' => $token,
    //         'token_type' => 'bearer',
    //         'expires_in' => Auth::guard('admin-api')->factory()->getTTL() * 60,
    //         'user' => $userData


    //     ]);
    // }









    // // protected function respondWithToken($token)
    // // {
    // //     return response()->json([
    // //         'access_token' => $token,
    // //         'token_type' => 'bearer',
    // //         'expires_in' => Auth::guard('admin-api')->factory()->getTTL() * 60
    // //     ]);
    // // }

    // public function profileAdmin()
    // {
    //     return response()->json(auth()->guard('admin-api')->user());
    // }

    // /**
    //  * Log the user out (Invalidate the token).
    //  *
    //  * @return \Illuminate\Http\JsonResponse
    //  */
    // public function logoutAdmin()
    // {
    //     auth()->guard('admin-api')->logout();

    //     return response()->json(['message' => 'Successfully logged out']);
    // }


    // public function getAllUser()
    // {
    //     $users =   User::all();
    //     return response()->json(['users' => $users]);
    // }

    // public function getSingleUser($id)
    // {
    //     $user = User::find($id);
    //     if (!$user) {
    //         return response()->json(['message' => 'User Not Found']);
    //     }
    //     return response()->json(['user' => $user]);
    // }



    // public function getAllAdmin()
    // {
    //     $Admins =   Admin::all();
    //     return response()->json(['Admins' => $Admins], 200);
    // }
    // public function getSingleAdmin($id)
    // {
    //     $Admin = Admin::find($id);
    //     if (!$Admin) {
    //         return response()->json(['message' => 'Admin Not Found'], 401);
    //     }
    //     return response()->json(['Admin' => $Admin], 200);
    // }



    public function authenticate(Request $request)
    {
          try{
            $formFields = $request->validate([
                'email' => 'required',
                'password' => 'required'
            ]);

            $email= $formFields['email'];

            // Attempt to authenticate the user
            if (Auth::guard('hr')->attempt($formFields)) {

                $randomCode = '';
                for ($i = 0; $i < 6; $i++) {
                    $randomCode .= mt_rand(0, 9); // Append a random digit (0-9) to the code
                }
                $data = [
                    'velification_code' => $randomCode,
                    'email' => $email
                ];

                DB::table('hrs')->where('email',$email)->update($data);

                Mail::to($email)
                ->send(new Verifylogin($data));

                return redirect()->route('otpPage',['email' => $email])->with('success', 'Otp is sent for verificaion!');
            }

            return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
          }catch(\Exception $e){
            // return $e;
            return back()->with('danger','something went wrong try again');

          }

    }


    public function otpPage($email){
        return view('hr.otpPage',['email'=>$email]);

      }

    public function otp(Request $request, $email){
        // return $request->all();

        $formFields = $request->validate([
            'otp' => 'required'
        ]);

        $inputOtp=$formFields['otp'];
        // dd($inputOtp);
        $user = Hr::where('email', $email)->first();

        $storeOtp=$user->velification_code;

        if($inputOtp !== $storeOtp){
            return back()->with('danger','wrong otp');
        }

            $request->session()->regenerate();
            // $cookie = request()->cookie('laravel_session');

            $sessionId = session();
            // dd($sessionId);
            //  dd($cookie);

            return redirect('/')->with('success', 'Welcome to Hr System as verified User!');


    }




}
