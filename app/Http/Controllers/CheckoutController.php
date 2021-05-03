<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Cart;
use App\Order;
use DateTime;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Cart::total() <= 0)  {
            return redirect()->route('products.index');
        }
        Stripe::setApiKey('sk_test_51I5qyyHGmSftft1XT4J34kJxNQD97hn0EO0bQ3qHgafBo2DSRv0PE61nh8ZIbdJBLkRQL3g41LORBCis3tphxhfd00QvgOFnna');

        $intent = PaymentIntent::create([
            'amount' => round(Cart::total()),
            'currency' => 'usd',
            'payment_method_types' => ['card'],
            'metadata' => [
                "userId" => 12,
            ]
        ]);

        $client_secret = Arr::get($intent, "client_secret");

        return view("checkout.index", ['client_secret' => $client_secret]);
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
        $data = $request->json()->all();

        $order = new Order();

        $order->payment_intend_id = $data["paymentIntent"]["id"];
        $order->amount = $data["paymentIntent"]["amount"];
        // get date payment
        $date_payment = (new DateTime())
                ->setTimestamp($data["paymentIntent"]["created"])
                ->format("Y-m-d H:i:s");
        // set date
        $order->payment_created_at = $date_payment;

        $products = [];
        $i = 0;

        foreach (Cart::content() as $product) {
            $products["product_".$i][] = $product->model->title;
            $products["product_".$i][] = $product->model->price;
            $products["product_".$i][] = $product->qty;
            $i++;
        }

        $order->products = serialize($products);
        $order->user_id = Auth()->user()->id;
        $order->save();

        if($data["paymentIntent"]["status"] === "succeeded"){
            Cart::destroy();
            Session::flash("success", "Your order is okay");
            return response()->json(["success" => "Payment Intent Succeeded"]);
        }
        else{
            return response()->json(["error" => "Payment Intent Not Succeeded"]);
        }
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show success page after payment
     * 
     * @return \Illuminate\Http\Response
     */
    public function success() {
        // check if success session exist, else redirect
        return Session::has("success") ? view("checkout.success") : redirect()->route("products.index");
    }
}
