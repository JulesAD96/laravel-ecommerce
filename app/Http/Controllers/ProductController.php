<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if($request->category){
            $products = Product::with("categories")->whereHas("categories", function($query){
                $query->whereSlug(request()->category);
            })->paginate(8);
        }else {
            $products = Product::with("categories")->paginate(6);
        }
    
        return view('products.index')->with('products', $products);
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();

        return view('products.show')->with('product', $product);
    }


    public function search() {
        // validate data
        request()->validate([
            "q" => "required|string|min:2"
        ]);
        // get param in request
        $q = request()->input("q");

        $products = Product::where("title", "like", "%$q%")
                    ->orWhere("description", "like", "%$q%")
                    ->paginate(6);
        
        return view("products.search")->with("products", $products);
    }
}
