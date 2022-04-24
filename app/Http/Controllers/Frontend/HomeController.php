<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Auth;
use Cart;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

/**
 * Class HomeController.
 */
class HomeController
{
    public $userId;
    public $cost;

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
//        $miles = $request->input('miles_input');
        $miles = 10;
        $time = $request->input('time_input');
        $date = $request->input('date_input');
        // change to ID
        $id = $request->input('type_id');
        // change to ID
        //dd($id);
        $product = Product::findOrFail($id);
        $pallet = $product->pallets;
        // create user id if not logged in
        if(isNull(Auth::id())){
            $this->userId = uniqid();
        } else{
            $this->userId = Auth::id();
        }
        $this->cost = $miles * $product->per_mile;
        // min charge applied
        if($this->cost < $product->min_charge){
            $this->cost = $product->min_charge;
        }

        // place order in cart
        // from products table
        Cart::session($this->userId)->add([
            'id' => $id,
            'name' => $product->type,
            'price' => $this->cost,
            'quantity' => 1,
        ]);

        $item = Cart::getContent();
        return view('frontend.checkout', compact('item', 'miles', 'pallet', 'time', 'date'));
    }
}
