<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\ValidationException;

class MainController extends Controller
{
    //
    public function store(Request $request, Model $model, array $rules,string $route,string $message)
    {
        try {
            $validatedData = $request->validate($rules);

            $item = $model::create($validatedData);

            // return response()->json($item, 201);
            return redirect()->route($route)->with('success', $message);
        }catch(ValidationException $e){
            return redirect()->back()->with('danger', 'something wrong with you inputs');

        }catch (\Exception $e) {


            // return redirect()->back()->with('error', $e->getMessage());
            return redirect()->back()->with('danger', 'something went wrong try again');
        }
    }




    public function read(Model $model, string $view, string $route)
    {
        try {
            $items = $model::all();
            return view($view, ['items'=>$items]);
        } catch (\Exception $e) {
            return redirect()->route($route)->with('danger', 'something went wrong');
        }
    }
}



// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Validation\ValidationException;

// class BaseController extends Controller
// {
//     public function store(Request $request, Model $model, array $rules, string $route, string $successMessage)
//     {
//         try {
//             $validatedData = $request->validate($rules);

//             $item = $model::create($validatedData);

//             return redirect()->route($route)->with('success', $successMessage);
//         } catch (ValidationException $e) {
//             return redirect()->back()->withErrors($e->errors())->withInput();
//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', $e->getMessage())->withInput();
//         }
//     }

//     public function read(Model $model, string $view, string $errorMessage)
//     {
//         try {
//             $items = $model::all();
//             return view($view, compact('items'));
//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', $errorMessage);
//         }
//     }

//     public function readSingle(Model $model, int $id, string $view, string $errorMessage)
//     {
//         try {
//             $item = $model::findOrFail($id);
//             return view($view, compact('item'));
//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', $errorMessage);
//         }
//     }

//     public function update(Request $request, Model $model, int $id, array $rules, string $route, string $successMessage)
//     {
//         try {
//             $validatedData = $request->validate($rules);

//             $item = $model::findOrFail($id);
//             $item->update($validatedData);

//             return redirect()->route($route)->with('success', $successMessage);
//         } catch (ValidationException $e) {
//             return redirect()->back()->withErrors($e->errors())->withInput();
//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', $e->getMessage())->withInput();
//         }
//     }

//     public function delete(Model $model, int $id, string $route, string $successMessage)
//     {
//         try {
//             $item = $model::findOrFail($id);
//             $item->delete();

//             return redirect()->route($route)->with('success', $successMessage);
//         } catch (\Exception $e) {
//             return redirect()->back()->with('error', $e->getMessage());
//         }
//     }
// }
