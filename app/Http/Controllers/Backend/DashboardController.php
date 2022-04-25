<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;


/**
 * Class DashboardController.
 */
class DashboardController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $orders = Order::all();
        return view('backend.dashboard', compact('orders'));
    }

    public function frontend()
    {
        $product = Product::all();

        return view('backend.matrix.index', compact('product'));
    }

    public function update(Request $request)
    {
        $product = Product::whereId($request->id)->update($request->except('_token','_method'));
        return redirect()->back();
    }
}
