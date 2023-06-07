<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CartFood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:api');
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function show_all_cart_food(Request $request){
    
        $request->validate([
            'user_id'=>'required'
        ]);

        if($request->user_id){
            $all_cart_food = CartFood::where('user_id',$request->user_id)
           ->where('status','1')
           ->with('foodDetails')
            ->get();
        }
        
        return response()->json([
            "status" => 200,
            "data" => $all_cart_food
        ],200);


    }

    public function add_to_cart(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "user_id" => "required|numeric",
            "food_id" => "required|numeric",
            "quantity" => "required|numeric",
            "price" => "required",
            "total_amount" => "required",
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $addToCart = new CartFood();
        $addToCart->user_id = $request->user_id;
        $addToCart->food_id = $request->food_id;
        $addToCart->quantity = $request->quantity;
        $addToCart->price = $request->price;
        $addToCart->total_amount = $request->total_amount;
        $addToCart->save();
       
        return response()->json([
            "message" => "Food added successfully",
            "status" => 200,
            "data" => $addToCart,
            
        ], 200);

      
    }

    public function update_food_quantity_in_cart(Request $request)
    {
    
        $cartUpdate = CartFood::find($request->id);
        
        if(!$cartUpdate){

            return response()->json([
                "message" => "Cart not found.",
            ],403);

        }

        if($cartUpdate->user_id != auth()->id()){
            return response()->json([
                "message" => "Permission denied.",
            ],403);
        }

        $validator = Validator::make($request->all(),[
            'quantity'=>'required|numeric'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 400);
        }

        $cartUpdate->quantity = $request->quantity;
        $cartUpdate->save();
        
        return response()->json([
            "message" => "Updated successfully",
            "status" => 200,
            "data" =>$cartUpdate
        ],200);

    }

    public function delete_cart(Request $request)
    {
    
        $cartDelete = CartFood::find($request->id);
        
        if(!$cartDelete){

            return response()->json([
                "message" => "Cart not found.",
            ],403);

        }

        if($cartDelete->user_id != auth()->id()){
            return response()->json([
                "message" => "Permission denied.",
            ],403);
        }

        $cartDelete->delete();
        return response()->json([
            "message" => "Cart deleted!",
        ],200);

    }

    public function guard()
    {
        return Auth::guard('api');

    }

   


}
