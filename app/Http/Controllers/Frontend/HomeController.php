<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

/**
 * Class HomeController.
 */
class HomeController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $vehicle = Product::all();
        return view('frontend.index', compact('vehicle'));
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function checkoutPost(Request $request)
    {
        //dd($request->all());
        $miles = $request->input('miles_input');
        $time = $request->input('time_input');
        $date = $request->input('date_input');
        $vehicle = $request->input('type_input');
        $product = Product::where('type', $vehicle)->get();
        // place order in cart
        // from products table
        $cost = 0;
        foreach ($product as $item => $value){
            $cost = $miles * $value->per_mile;
        }
        Cart::add([

        ]);

        dd($cost);
        return view('frontend.checkout');
    }
}
