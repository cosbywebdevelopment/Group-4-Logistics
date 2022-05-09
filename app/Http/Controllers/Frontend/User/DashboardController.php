<?php

namespace App\Http\Controllers\Frontend\User;

use App\Models\Order;
use Auth;

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
}
