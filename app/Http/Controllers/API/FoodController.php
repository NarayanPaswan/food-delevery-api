<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Category;

class FoodController extends Controller
{
    public function food_category()
    {
        
        $category = Category::where('status','active')->get();
        return response()->json([
            "status" => 200,
            "data" => $category
        ]);
    }

    public function newest_food()
    {
        
        $newest = Food::where('status','active')->orderBy('id', 'DESC')->limit(5)->get();
        return response()->json([
            "status" => 200,
            "data" => $newest
        ]);
    }

    public function all_products()
    {
        
        // $all_products = Food::where('status','active')->orderBy('id', 'DESC')->paginate(3);
        $all_products = Food::where('status','active')->orderBy('id', 'DESC')->get();
        return response()->json([
            "status" => 200,
            "data" => $all_products
        ]);
    }

    public function food_detail(Request $request){
        $request->validate([
            'food_id'=>'required'
        ]);

        if($request->food_id){
            $food_data = Food::where('id',$request->food_id)
            ->where('status','active')->get();
        }
        return response()->json([
            "status" => 200,
            "data" => $food_data
        ]);
   
    }
}
