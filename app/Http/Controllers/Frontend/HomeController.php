<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use Auth;
use Carbon\Carbon;
use Cart;
use Illuminate\Http\Request;
use Session;
use Stripe\Charge;
use Stripe\Stripe;
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
        $miles = $request->input('miles_input');
        $time = $request->input('time_input');
        $date = $request->input('date_input');
        $pickupAddress = $request->input('pickup_input');
        $dropoffAddress = $request->input('dropoff_input');
        $userId = '';
        $id = $request->input('type_id');

        $product = Product::findOrFail($id);
        $pallet = $product->pallets;
        // create user id if not logged in
        if(isNull(Auth::id())){
            $userId = uniqid();
        } else{
            $userId = Auth::id();
        }
        $this->cost = $miles * $product->per_mile;
        $cost = number_format((float)$this->cost, 2, '.', '');
        // min charge applied
        if($this->cost < $product->min_charge){
            $cost = $product->min_charge;
        }

        // place order in cart
        // from products table
        Cart::session($userId)->add([
            'id' => $id,
            'name' => $product->type,
            'price' => $cost,
            'quantity' => 1,
            'attributes' => [
                'miles'=>$miles,
                'time'=>$time,
                'date'=>$date,
                'package' => $pallet,
                'pickup' => $pickupAddress,
                'dropOff' => $dropoffAddress,
            ],
            'associatedModel' => $product
        ]);

//        dd(Cart::getContent());
        return view('frontend.checkout', compact('userId', 'miles', 'pallet', 'time', 'date'));
    }

    public function stripePost(Request $request)
    {
        // save cart to DB for ref Todo
        $items = Cart::session($request->userId)->getContent();
        //dd($items);
        $type = '';
        $cost = Cart::session($request->userId)->getTotal();
        $milesCart = 0;
        $time = '';
        $date = '';
        $package = '';
        $pickup = '';
        $dropOff = '';
        foreach ($items as $row){
            $type = $row->name;
            $milesCart = $row->attributes->miles;
            $time = $row->attributes->time;
            $date = $row->attributes->date;
            $package = $row->attributes->package;
            $pickup = $row->attributes->pickup;
            $dropOff = $row->attributes->dropOff;
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $charge = Charge::create ([
            "amount" => $cost * 100,
            "currency" => "gbp",
            "source" => $request->stripeToken,
            "description" => "Route " . $pickup . " to " . $dropOff . ' at ' . $time . ' ' . Carbon::parse($date)->format('d/m/Y')
            . ' vehicle ' . $type . ' load ' . $package
        ]);

        //dd($charge);
        if($charge->status == "succeeded"){
            // save order
            $order = Order::create([
                'email'=>'test Email',
                'type' =>$type,
                'pickup' => $pickup,
                'drop_off' => $dropOff,
                'time' => $time,
                'date' => $date,
                'package' => $package,
                'mileage' => $milesCart,
                'cost' => $charge->amount,
                'payment_method' =>$charge->payment_method,
            ]);
            // email customer and John
            return redirect()->route('frontend.index')->withFlashSuccess(__('Payment successful!'));
        }
        return redirect()->route('frontend.index')->withFlashDanger(__('Payment Failed, please try again!'));
    }
}
