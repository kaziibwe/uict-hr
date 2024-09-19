<?php

use App\Models\Hr;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HrController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DepartmentController;
use App\Models\Setting;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/hr/login', function () {
    return view('hr.login');
})->name('login');



Route::get('/hr/register', function () {
    try{
    $data = [
        'email' => 'phrunsys@cognospheredynamics.com',
        'name' => 'phrunsys',
        'phone' => '0785557587',
        'title' => 'hod',
        'dob' => '1945',
        'current_appointment' => '1945',
        'appointment_date' => '1945',
        'nin' => '1945',
        'tin' => '1945',
        'staff_number' => '1945',





        'password' => '123456',

    ];
    $data['password'] = bcrypt($data['password']);

    DB::table('hrs')->insert($data);
    // dd('done');
    return view('hr.login');

    }catch(\Exception $e){
        return $e;
    }
})->name('register');

Route::post('/hr/authenticate', [StaffController::class, 'authenticate'])->name('authenticate');

Route::get('otpPage/{email}', [StaffController::class, 'otpPage'])->name('otpPage');
Route::post('otp/{email}', [StaffController::class, 'otp'])->name('otpverifying');

Route::prefix('/')->namespace('App\Http\Controllers\Hr')->group(function () {

    Route::group(['middleware' => ['hr']], function () {

        Route::get('/', function () {

            $staff = User::All();
            $countStaff = $staff->count();

            $department = Department::All();
            $countDepartment = $department->count();

            $today = date('Y-m-d');
            // Filter attendance records by today's date
            $attendances = Attendance::whereDate('singin', $today)->get();

            $attendanceCount = $attendances->count();


            return view('welcome', ['countStaff' => $countStaff, 'countDepartment' => $countDepartment, 'attendanceCount' => $attendanceCount]);
        });



        Route::get('/manage_staff', [StaffController::class, 'manage_staff'])->name('manage_staff');

        Route::get('/todayAttendance', [AttendanceController::class, 'todayAttendance'])->name('todayAttendance');

        Route::get('/add_staff', function () {

            $departments = Department::all();
            return view('hr.manage_staff.add_staff', ['departments' => $departments]);
        })->name('add_staff');

        Route::post('registerUser', [UserController::class, 'registerUser'])->name('registerUser');

        Route::get('/view_staff_profile/{id}', function ($id) {

            $staff = User::find($id);
            return view('hr.manage_staff.view_staff_profile', ['staff' => $staff]);
        })->name('view_staff_profile');

        Route::get('/edit_staff/{id}', function ($id) {

            $departments = Department::all();
            $staff = User::find($id);
            $selectedDepartmentId = $staff->department_id;

            return view('hr.manage_staff.edit_staff', ['departments' => $departments, "staff" => $staff, 'selectedDepartmentId' => $selectedDepartmentId]);
        })->name('edit_staff');

        Route::put('updateUser/{id}', [StaffController::class, 'updateUser'])->name('updateUser');

        Route::get('/manage_department', function () {

            $departments = Department::all();
            return view('hr.manage_staff.manage_department', ['departments' => $departments]);
        })->name('manage_department');

        Route::get('/attendance_history', function (Request  $request) {

            $history = $request->input('date');

            $today = date('Y-m-d');

            $date = $history ? $history : $today;

            $attendances = Attendance::whereDate('singin', $date)->get();
            //  return $attendances;
            //  return response()->json(['message' =>$attendances]);



            // return view('hr.manage_staff.today_attendance',['attendances',$attendances]);
            return view("hr.manage_staff.attendance_history", ['attendances' => $attendances]);

            // return view('hr.manage_staff.attendance_history');
        })->name('attendance_history');

        Route::get('/add_department', function () {
            return view('hr.manage_staff.add_department');
        })->name('add_department');

        Route::post('createDepartment', [DepartmentController::class, 'createDepartment'])->name('createDepartment');


        Route::get('/edit_department/{id}', function ($id) {

            $department = Department::find($id);
            $staffs = $department->users()->get();
            return view('hr.manage_staff.edit_department', ['department' => $department, 'staffs' => $staffs]);
        })->name('edit_department');

        Route::put('updateDepartment/{id}', [DepartmentController::class, 'updateDepartment'])->name('updateDepartment');

        Route::delete('deleteDepartment/{id}', [DepartmentController::class, 'deleteDepartment'])->name('deleteDepartment');


        // logoutUser
        route::post('/logout', [StaffController::class, 'logout'])->name('logout');

        // route to profile page
        Route::get('hrProfilePage', function () {
            $hr = Auth::guard('hr')->user(); // Assuming you're using Laravel's built-in authentication
            //  $hr = User::find(Auth::id());
            // dd($hr);
            return view('hr.profile.hr_profile', ['hr' => $hr]);
        })->name('hrProfilePage');

        // hr_edit
        Route::get('/hr_edit/{id}', [HrController::class, 'hr_edit'])->name('hr_edit');

        //  updateHr
        Route::put('/updateHr/{id}', [HrController::class, 'updateHr'])->name('updateHr');

        // route change password
        Route::get('changePasswordHr/{id}', function ($id) {
            $hr = Hr::find($id);
            // dd($hr->id);
            $admin = Auth::guard('hr')->user(); // Assuming you're using Laravel's built-in authentication
            if ($admin->id !== $hr->id) {
                return redirect('/login');
            }

            return view('hr.profile.changePasswordHr', [
                'hr' => $hr
            ]);
        })->name('changePasswordHr');



        // editpasswordHr
        Route::put('/editpasswordHr/{id}',[HrController::class,'editpasswordHr'])->name('editpasswordHr');

        //settings
        // Route::get('/allSettings',[HrController::class,'allSettings'])->name('allSettings');
        Route::get('/allSettings', function () {

            $hr = Auth::guard('hr')->user(); // Assuming you're using Laravel's built-in authentication
            if (!$hr) {
                return redirect('/login');
            }
            $setting = Setting::find(1);

            return view('hr.settings.allSettings',[
                 'setting'=>$setting,
                'hr'=>$hr
            ]);
        })->name('allSettings');

        // hr_edit_senser
        Route::get('/hr_edit_senser', function () {

            $hr = Auth::guard('hr')->user(); // Assuming you're using Laravel's built-in authentication
            if (!$hr) {
                return redirect('/login');
            }

            return view('hr.settings.hr_edit_senser',['hr'=>$hr]);
        })->name('hr_edit_senser');


        // updateSensor
        Route::put('/updateSensor', function (Request $request) {

            try{

            $hr = Auth::guard('hr')->user(); // Assuming you're using Laravel's built-in authentication
            if (!$hr) {
                return redirect('/login');
            }
            $formFields=$request->validate([
                'sensor'=>"required |max:17"
            ]);

            DB::table('settings')->where('id',1)->update($formFields);

            return redirect()->route('allSettings',$hr->id)->with('success', 'Senser changed successfully!');


        }catch(\Exception $e){
            return $e;
            return redirect()->back()->with('danger', 'something went wrong try agian!');
        }
        })->name('updateSensor');


    });
});
