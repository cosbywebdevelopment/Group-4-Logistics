<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\Product;
use App\Notifications\NewBooking;
use Auth;
use Carbon\Carbon;
use Cart;
use Darryldecode\Cart\CartCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
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
        $vehicle = Product::where('display', 1)->get();
        return view('frontend.index', compact('vehicle'));
    }

    public function checkout(Request $request)
    {
        $payment = false;
        $userId = 0;
        $order = Order::findOrFail($request->id);
        $miles = $order->miles;
        $pallet = $order->pallet;
        $time = $order->time;
        $date = $order->date;
        $min_charge = $request->min_charge;
        $after_5 = $request->after_5;
        $weekend_collection = $request->weekend_collection;
        $surcharge = $request->surcharge;
        $pickupPostcode = $order->pickupPostcode;
        $dropoffPostcode = $order->dropoffPostcode;
        $dropTime = $order->dropTime;
        $dropDate = $order->dropDate;
        $ref = $order->ref;
        $pickup_contact = $order->pickup_contact;
        $delivery_contact = $order->delivery_contact;
        $delivery_info = $order->delivery_info;
        $size = $order->size;
        $weight = $order->weight;
        $notes = $order->notes;
        $confirm = $order->confirm;
        $type = $order->type;

        return view('frontend.checkout', compact('userId', 'miles', 'pallet', 'time', 'date',
            'min_charge', 'after_5', 'weekend_collection', 'surcharge', 'pickupPostcode', 'dropoffPostcode', 'dropTime', 'dropDate', 'payment',
            'ref', 'pickup_contact', 'delivery_contact', 'delivery_info', 'size', 'weight', 'notes', 'confirm', 'type'));
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
        $ref = $request->input('ref');
        $pickup_contact = $request->input('pickup_contact');
        $delivery_contact = $request->input('delivery_contact');
        $delivery_info = $request->input('delivery_info');
        $size = $request->input('size');
        $weight = $request->input('weight');
        $notes = $request->input('notes');
        $confirm = $request->input('confirm');
        $userId = Auth::id();
        Cart::session($userId)->clear();
        $id = $request->input('type_id');
        $surcharge = false;
        $weekend_collection = false;
        $after_5 = false;
        $min_charge = false;

        $product = Product::findOrFail($id);
        $type = $product->type;
        $pallet = $product->pallets;
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

        // ADDED VAT
        if(Auth::user()->credit){
            $vat = new CartCondition(array(
                'name' => 'VAT 20%',
                'type' => 'tax',
                'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
                'value' => '20%',
                'attributes' => array( // attributes field is optional
                    'description' => 'Value added tax'
                )
            ));
            Cart::session($userId)->add([
                'id' => $id,
                'name' => $product->type,
                'price' => $cost,
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
                    'ref' => $ref,
                    'pickup_contact' => $pickup_contact,
                    'delivery_contact' => $delivery_contact,
                    'delivery_info' => $delivery_info,
                    'size' => $size,
                    'weight' => $weight,
                    'notes' => $notes,
                    'confirm' => $confirm,
                ],
                'associatedModel' => $product
            ])->condition($vat);
        } else{
            Cart::session($userId)->add([
                'id' => $id,
                'name' => $product->type,
                'price' => $cost,
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
                    'ref' => $ref,
                    'pickup_contact' => $pickup_contact,
                    'delivery_contact' => $delivery_contact,
                    'delivery_info' => $delivery_info,
                    'size' => $size,
                    'weight' => $weight,
                    'notes' => $notes,
                    'confirm' => $confirm,
                ],
                'associatedModel' => $product
            ]);
        }

        // save order if logged in and has credit
        if(Auth::hasUser() && Auth::user()->credit){
            //dd(round(Cart::getTotal(),2));
            if(Auth::user()->discount){
                //$discount = $cost * Auth::user()->discount/100;
                //$cost = $cost - $discount;
                $discountCondition = new CartCondition(array(
                    'name' => 'Discount',
                    'type' => 'tax',
                    'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                    'value' => '-'.Auth::user()->discount.'%',
                    'attributes' => array( // attributes field is optional
                        'description' => 'Discount'
                    )
                ));
                Cart::session($userId)->condition($discountCondition);
                //dd(round(Cart::session($userId)->getTotal(), 2)*100);
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
                'cost' => round(Cart::session($userId)->getTotal(), 2)*100,
                'payment_method' =>'account',
                'ref' => $ref,
                'pickup_contact' => $pickup_contact,
                'delivery_contact' => $delivery_contact,
                'delivery_info' => $delivery_info,
                'size' => $size,
                'weight' => $weight,
                'notes' => $notes,
                'confirm' => $confirm,
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
            // send email
            $array = Arr::except($order->toArray(), ['id', 'created_at', 'updated_at', 'payment_method']);
            Auth::user()->notify(new NewBooking($array));

            return redirect()->route('frontend.checkout', ['id' => $order->id, 'min_charge' => $min_charge,
                'after_5' => $after_5, 'weekend_collection' => $weekend_collection, 'surcharge' => $surcharge])->withInput();
        }
        $payment = true;

        return view('frontend.checkout', compact('userId', 'miles', 'pallet', 'time', 'date',
        'min_charge', 'after_5', 'weekend_collection', 'surcharge', 'pickupPostcode', 'dropoffPostcode', 'dropTime', 'dropDate', 'payment',
        'ref', 'pickup_contact', 'delivery_contact', 'delivery_info', 'size', 'weight', 'notes', 'confirm', 'type'));
    }

    // make payment and saves order to DB
    public function stripePost(Request $request)
    {

        // save cart to DB for ref Todo
        $items = Cart::session($request->userId)->getContent();
        //dd($items);
        $type = '';
        $cost = round(Cart::session($request->userId)->getTotal(), 2);
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

            $ref = $row->attributes->ref;
            $pickup_contact = $row->attributes->pickup_contact;
            $delivery_contact = $row->attributes->delivery_contact;
            $delivery_info = $row->attributes->delivery_info;
            $size = $row->attributes->size;
            $weight = $row->attributes->weight;
            $notes = $row->attributes->notes;
            $confirm = $row->attributes->confirm;
        }

        Stripe::setApiKey(env('STRIPE_SECRET'));
        // if user has no credit

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
                    'ref' => $ref,
                    'pickup_contact' => $pickup_contact,
                    'delivery_contact' => $delivery_contact,
                    'delivery_info' => $delivery_info,
                    'size' => $size,
                    'weight' => $weight,
                    'notes' => $notes,
                    'confirm' => $confirm,
                ]);

                // email customer and John
                $array = Arr::except($order->toArray(), ['id', 'created_at', 'updated_at', 'payment_method']);
                Auth::user()->notify(new NewBooking($array));

                return redirect()->route('frontend.index')->withFlashSuccess(__('Payment successful, an email has been sent to you!'));
            }

        return redirect()->route('frontend.index')->withFlashDanger(__('Payment Failed, please try again!'));
    }
}
