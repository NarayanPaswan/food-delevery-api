<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Country;
use App\Models\Jobform;
use App\Models\State;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class JobPortalController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function all_jobs(Request $request){
    
        $all_jobs = Jobform::paginate(10);
        return response()->json([
            "status" => 200,
            "data" => $all_jobs
        ],200);
    }

    public function add_job(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "user_id" => "required|numeric",
            "name" => "required",
            'resume' => 'mimes:pdf,doc,docx|max:5048',
            'photo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $addJob = new Jobform();
        
        if($request->hasFile('resume')){
            $fileName = time().".".$request->file('resume')->getClientOriginalExtension();
            $request->file('resume')->storeAs('public/resume',$fileName);
            $addJob->resume = $fileName;
        }
          if($request->hasFile('photo')){
            $fileNameImage = time().".".$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/photo',$fileNameImage);
            $addJob->photo = $fileNameImage;
        }
        

        $addJob->user_id = $request->user_id;
        $addJob->name = $request->name;
        $addJob->contact_number = $request->contact_number;
        $addJob->date_of_birth = $request->date_of_birth;
        $addJob->address = $request->address;
        $addJob->postal_code = $request->postal_code;
        
        if($request->country_id != null){
        $addJob->country_id = $request->country_id;
        $country = Country::find($request->country_id);
        $addJob->country_name = $country->country_name;    
        }
        if($request->state_id != null){
        $addJob->state_id = $request->state_id;
        $states = State::find($request->state_id);
        $addJob->state_name = $states->state_name;    
        }
        if($request->city_id != null){
        $addJob->city_id = $request->city_id;
        $cities = City::find($request->city_id);
        $addJob->city_name = $cities->city_name;    
         }
        $addJob->gender = $request->gender;
        $addJob->marital_status = $request->marital_status;
        $addJob->work_experience = $request->work_experience;
        $addJob->company_name = $request->company_name;
        $addJob->designation = $request->designation;
        $addJob->duration_from = $request->duration_from;
        $addJob->duration_upto = $request->duration_upto; 
        
        
        $addJob->save();
       
        return response()->json([
            "message" => "added successfully",
            "status" => 200,
            "item" => $addJob,
            
        ], 200);

      
    }

    public function update_job(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name" => "required",
            'resume' => 'mimes:pdf,doc,docx|max:5048',
            'photo' => 'mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
    
        $jobUpdate = Jobform::find($request->id);
        
        if(!$jobUpdate){

            return response()->json([
                "message" => "Data not found.",
            ],403);

        }

        if($jobUpdate->user_id != auth()->id()){
            return response()->json([
                "message" => "Permission denied.",
            ],403);
        }

        $validator = Validator::make($request->all(),[
            'name'=>'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
        if($request->hasFile('resume')){
            $fileName = time().".".$request->file('resume')->getClientOriginalExtension();
            $request->file('resume')->storeAs('public/resume',$fileName);
            $jobUpdate->resume = $fileName;
        }
        if($request->hasFile('photo')){
            $fileNameImage = time().".".$request->file('photo')->getClientOriginalExtension();
            $request->file('photo')->storeAs('public/photo',$fileNameImage);
            $jobUpdate->photo = $fileNameImage;
        }

        $jobUpdate->name = $request->name;
        $jobUpdate->contact_number = $request->contact_number;
        $jobUpdate->date_of_birth = $request->date_of_birth;
        $jobUpdate->address = $request->address;
        $jobUpdate->postal_code = $request->postal_code;
        if($request->country_id != null){
            $jobUpdate->country_id = $request->country_id;
            $country = Country::find($request->country_id);
            $jobUpdate->country_name = $country->country_name;    
            }
            if($request->state_id != null){
            $jobUpdate->state_id = $request->state_id;
            $states = State::find($request->state_id);
            $jobUpdate->state_name = $states->state_name;    
            }
            if($request->city_id != null){
            $jobUpdate->city_id = $request->city_id;
            $cities = City::find($request->city_id);
            $jobUpdate->city_name = $cities->city_name;    
             }
            $jobUpdate->gender = $request->gender;
            $jobUpdate->marital_status = $request->marital_status;
            $jobUpdate->work_experience = $request->work_experience;
            $jobUpdate->company_name = $request->company_name;
            $jobUpdate->designation = $request->designation;
            $jobUpdate->duration_from = $request->duration_from;
            $jobUpdate->duration_upto = $request->duration_upto; 
            

        
        $jobUpdate->save();
        
        return response()->json([
            "message" => "Updated successfully",
            "status" => 200,
            "item" =>$jobUpdate
        ],200);

    }

    public function delete_job(Request $request)
    {
    
        $jobDelete = Jobform::find($request->id);
        
        if(!$jobDelete){

            return response()->json([
                "message" => "Data not found.",
            ],403);

        }

        if($jobDelete->user_id != auth()->id()){
            return response()->json([
                "message" => "Permission denied.",
            ],403);
        }

        $jobDelete->delete();
        return response()->json([
            "message" => "Job deleted!",
        ],200);

    }

    public function all_countries(Request $request){
    
        $all_countries = Country::get();
        return response()->json([
            "status" => 200,
            "data" => $all_countries
        ],200);
    }

    public function country_wise_state(Request $request){
        
        $validator = Validator::make($request->all(),[
            "country_id" => "required|numeric",
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
    
        $all_states = State::where('country_id',$request->country_id)->get();
        return response()->json([
            "status" => 200,
            "data" => $all_states
        ],200);
    }
    public function state_wise_city(Request $request){
       
        $validator = Validator::make($request->all(),[
            "state_id" => "required|numeric",
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }
    
        $all_states = City::where('state_id',$request->state_id)->get();
        return response()->json([
            "status" => 200,
            "data" => $all_states
        ],200);
    }
    
}
