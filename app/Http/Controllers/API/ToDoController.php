<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\ToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ToDoController extends Controller
{
    public function get_task()
    {
        
        $toDoData = ToDo::
        select('id','name','description')
        ->paginate(10); 
        // $toDoData = ToDo::paginate(10); 
        // $toDoData = ToDo::select('id','name','description')->get();
        return response()->json([
            "status" => 200,
            "data" => $toDoData
            
        ]);
    }

    public function add_employee(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "country" => "required",
            "state" => "required",
            "pin_no" => "required"
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $addToEmployee = new Employee();
        $addToEmployee->country = $request->country;
        $addToEmployee->state = $request->state;
        $addToEmployee->pin_no = $request->pin_no;
        $addToEmployee->save();
       
        return response()->json([
            "message" => "Added successfully",
            "status" => 200,
            "data" => $addToEmployee,
            
        ], 200);

      
    }
}
