<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;

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
        // place order in cart
        // from products table

        return view('frontend.checkout');
    }
}
