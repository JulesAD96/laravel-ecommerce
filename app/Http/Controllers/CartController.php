<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("cart.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Search product in table
        $duplicate = Cart::search(function($cartItem , $rowId) use ($request){
            return $cartItem->id == $request->product_id;
        });
        // duplicate is not empty redirect user with message
        if($duplicate->isNotEmpty()) {
            return redirect()->route("products.index")->with("success", "Product exist in your cart");
        }
        // get current product
        $product = Product::find($request->product_id);

        Cart::add($product->id, $product->title, 1,$product->price)
            ->associate("App\Product");

        return redirect()->route("products.index")->with("success", "Product has been added");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        $data = $request->json()->all();

        $validator = Validator::make($request->all(), [
            "qty" => "required|numeric|between:1, 10"
        ]);

        if($validator->fails()){

            Session::flash("danger", "The product quantity must be between 1, 10 ");
            return response()->json(["error", "The quantity has not been update"]);
        }
        // Update cart
        Cart::update($rowId, $data["qty"]);
        
        Session::flash("success", "The new product quantity is " . $data["qty"] . " .");

        return response()->json(["success", "The quantity has been update"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);

        return back()->with("success", "Product was deleted of your card");
    }
}
