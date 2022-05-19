<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Order;
use Auth;
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
        $orders = Order::where('email', Auth::user()->email)->orderBy('created_at', 'desc')->get();
        return view('frontend.user.dashboard', compact('orders'));
    }

    public function show($id){
        $order = Order::findOrFail($id);
        //dd($order);

        return view('frontend.user.show', compact('order'));
    }
}
