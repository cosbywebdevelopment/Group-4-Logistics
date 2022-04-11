<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;

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
        return view('backend.dashboard');
    }

    public function frontend()
    {
        $product = Product::all();

        return view('backend.matrix.index', compact('product'));
    }
}
