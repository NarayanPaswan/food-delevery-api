<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StudentController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function all_students(Request $request){
    
        $all_students = Student::paginate(10);
        return response()->json([
            "status" => 200,
            "data" => $all_students
        ],200);
    }

    public function add_job(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "user_id" => "required|numeric",
            "name" => "required",
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $addStudent = new Student();
        $addStudent->user_id = $request->user_id;
        $addStudent->name = $request->name;
        $addStudent->save();
       
        return response()->json([
            "message" => "added successfully",
            "status" => 200,
            "item" => $addStudent,
            
        ], 200);

      
    }

    
}
