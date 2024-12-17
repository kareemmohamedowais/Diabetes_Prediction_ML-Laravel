<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = product::all();
        return response()->json(['data'=>$products,'message'=>'ok','status'=>200]);
    }
}
