<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDepartmentRequest;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\FuncCall;

class DepartmentController extends MainController
{
    //

    //  controller to store department
    public function createDepartment(StoreDepartmentRequest $request)
    {
        $rule = $request->rules();
        $route = 'manage_department';
        $message = 'Department created successfully!';
        return parent::store($request, new Department, $rule, $route, $message);
    }


    // public function createDepartment(Request $request)
    // {
    //     try {
    //         $formFields = $request->validate([
    //             'name' => 'required',
    //             'description' => 'required',
    //         ]);
    //         $data = Department::create($formFields);
    //         if ($data) {
    //             return response()->json(["data" => $data, 'status' => true], 200);
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



    //



    public function updateDepartment(Request $request, $id)
    {

        $user = Department::find($id);
        if (!$user) {
            return response()->json(['message' => 'User Not Found'], 401);
        }

        // return $request->all();
        $formFields = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'stuff_id' => 'nullable',
        ]);
        try {

            Department::where('id', $id)->update($formFields);

            return redirect()->route('manage_department')->with('success', 'Department updated successfully');
        } catch (\Exception $e) {
            // Catch any other exceptions and return a generic error response
            return redirect()->back()->with('danger', "some thing wen't wrong try again");
        }
    }

    // public function updateDepartment(Request $request, $id)
    // {

    //     try {
    //         $user = Department::find($id);
    //         if (!$user) {
    //             return response()->json(['message' => 'User Not Found'], 401);
    //         }
    //         $formFields = $request->validate([
    //             'name' => 'required',
    //             'description' => 'required',
    //             'sfaff_id' => 'string',
    //         ]);
    //         $data = Department::where('id', $id)->update($formFields);
    //         if ($data) {
    //             return response()->json(["data" => $data, 'status' => true], 200);
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



    public function getAllDepartments()
    {
        $departments =   Department::all();
        return response()->json(['departments' => $departments], 200);
    }

    public function getSingleDepartment($id)

    {


        $department = Department::find($id);
        if (!$department) {
            return response()->json(['message' => 'department Not Found'], 401);
        }
        return response()->json(['department' => $department]);
    }


    // delete chats
//     public function deleteDepartment($id)
//     {
//         try {
//             $department = Department::find($id);
//             if (!$department) {
//                 return response()->json([
//                     'message' => 'department Not found'
//                 ], 401);
//             }
//             $department->delete();
//             return response()->json(['message' => 'Department deleted successfully
// '], 200);
//         } catch (Exception $e) {
//             return response()->json([], 500);
//         }
//     }




    public function deleteDepartment($id){
        $department = Department::find($id);
        $department->delete();
        return redirect()->back()->with('danger', "Department deleted successfully");

    }


}
