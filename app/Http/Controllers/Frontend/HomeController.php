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
use Stripe\Customer;
use Stripe\Stripe;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

/**
 * Class HomeController.
 */
class HomeController
{
    public $userId;
    public $cost;
    public $postcodes = ['EC1', 'EC2', 'EC3', 'EC4', 'SE1', 'SW1', 'W1', 'WC1', 'WC2'];

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

    // run through the matrix and updates cost
    public function checkoutPost(Request $request)
    {
        $miles = $request->input('miles_input');
        $time = $request->input('time_input');
        $date = $request->input('date_input');
        $dropTime = $request->input('time_off_input');
        $dropDate = $request->input('date_off_input');
        $pickupAddress = $request->input('pickup_input');
        $dropoffAddress = $request->input('dropoff_input');
        $pickupPostcode = $request->input('pickup_postcode_input');
        $dropoffPostcode = $request->input('drop_off_postcode_input');
        $userId = '';
        $id = $request->input('type_id');
        $surcharge = false;
        $weekend_collection = false;
        $after_5 = false;
        $min_charge = false;

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
            $min_charge = true;
        }

        // after 5pm ? add 10%
        if(Carbon::parse($time)->format('H:i') > "17:00"){
            // add 10%
            $percent = $cost * $product->collection_5 / 100;
            $cost = $cost + $percent;
            $after_5 = true;
        }
        //dd($cost);
        // at the weekend ? add 20%
        $day = Carbon::parse($date)->isWeekend();
        if($day){
            $percent = $cost * $product->collection_weekend / 100;
            $cost = $cost + $percent;
            $weekend_collection = true;
        }
        // in postcode congestion charge ? add surcharge
        foreach ($this->postcodes as $postcode){
            if(str_starts_with($pickupPostcode, $postcode) || str_starts_with($dropoffPostcode, $postcode)){
                // add surcharge
                $cost = $cost + $product->surcharge;
                $surcharge = true;
            }
        }

        // place order in cart
        // from products table
        Cart::session($userId)->add([
            'id' => $id,
            'name' => $product->type,
            'price' => number_format((float)$cost, 2, '.', ''),
            'quantity' => 1,
            'attributes' => [
                'miles'=>$miles,
                'time'=>$time,
                'date'=>$date,
                'drop_date' => $dropDate,
                'drop_time' => $dropTime,
                'package' => $pallet,
                'pickup' => $pickupAddress,
                'dropOff' => $dropoffAddress,
            ],
            'associatedModel' => $product
        ]);

        // save order if logged in and has credit
        if(Auth::hasUser() && Auth::user()->credit){
            if(Auth::user()->discount){
                $discount = $cost * Auth::user()->discount/100;
                $cost = $cost - $discount;
            }
            $order = Order::create([
                'email'=>Auth::user()->email,
                'type' =>$product->type,
                'pickup' => $pickupAddress,
                'drop_off' => $dropoffAddress,
                'time' => $time,
                'date' => $date,
                'drop_date' => $dropDate,
                'drop_time' => $dropTime,
                'package' => $pallet,
                'mileage' => $miles,
                'cost' => $cost*100,
                'payment_method' =>'account',
            ]);
            if(!Auth::user()->sripe_id) {
                Stripe::setApiKey(env('STRIPE_SECRET'));
                $customer = Customer::create([
                    'email' => Auth::user()->email,
                    'description' => Auth::user()->company,
                    'name' => Auth::user()->name,
                ]);
                // save customer id to user table
                Auth::user()->sripe_id = $customer->id;
                Auth::user()->save();
                //dd(Auth::user());
            }
            return redirect()->route('frontend.index')->withFlashSuccess(__('Route added, an email has been sent to you!'));
        }
       // dd(Cart::getContent());
        return view('frontend.checkout', compact('userId', 'miles', 'pallet', 'time', 'date',
        'min_charge', 'after_5', 'weekend_collection', 'surcharge', 'pickupPostcode', 'dropoffPostcode', 'dropTime', 'dropDate'));
    }

    // make payment and saves order to DB
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
        $drop_date = '';
        $drop_time = '';
        foreach ($items as $row){
            $type = $row->name;
            $milesCart = $row->attributes->miles;
            $time = $row->attributes->time;
            $date = $row->attributes->date;
            $drop_date = $row->attributes->drop_date;
            $drop_time = $row->attributes->drop_time;
            $package = $row->attributes->package;
            $pickup = $row->attributes->pickup;
            $dropOff = $row->attributes->dropOff;
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));
        // if user has no credit
        if(!Auth::user()->credit){
            $charge = Charge::create ([
                "amount" => $cost * 100,
                "currency" => "gbp",
                "source" => $request->stripeToken,
                "description" => "Route " . $pickup . ' at ' . $time . ' ' . Carbon::parse($date)->format('d/m/Y')
                    . " drop off " . $dropOff . ' at ' . $drop_time . ' ' . Carbon::parse($drop_date)->format('d/m/Y')
                . ' vehicle ' . $type . ' load ' . $package
            ]);

            if($charge->status == "succeeded"){
                // save order
                $order = Order::create([
                    'email'=>$request->email,
                    'type' =>$type,
                    'pickup' => $pickup,
                    'drop_off' => $dropOff,
                    'time' => $time,
                    'date' => $date,
                    'drop_date' => $drop_date,
                    'drop_time' => $drop_time,
                    'package' => $package,
                    'mileage' => $milesCart,
                    'cost' => $charge->amount,
                    'payment_method' =>$charge->payment_method,
                ]);

                // email customer and John

                return redirect()->route('frontend.index')->withFlashSuccess(__('Payment successful, an email has been sent to you!'));
            }

        }
        return redirect()->route('frontend.index')->withFlashDanger(__('Payment Failed, please try again!'));
    }
}
