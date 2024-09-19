<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class BaseController extends Controller
{
    //



    public function store(Request $request, Model $model, array $rules)
    {
        $validatedData = $request->validate($rules);

        $item = $model::create($validatedData);

        return response()->json($item, 201);
    }

}
