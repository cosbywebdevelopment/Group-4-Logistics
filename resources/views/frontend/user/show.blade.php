@extends('frontend.layouts.app')
@section('title', __('Dashboard'))

@section('content')

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <x-frontend.card>
                    <x-slot name="header">
                        <h2>Booking Ref: <b>{{ $order->ref }}</b></h2>
                    </x-slot>

                    <x-slot name="body">
                        <div>
                            <p>Vehicle: <b>{{ $order->type }}</b></p>
                            <p>Pickup Address: <b>{{ $order->pickup }}</b></p>
                            <p>Drop Off Address: <b>{{ $order->drop_off }}</b></p>
                            <p>Pickup Time: <b>{{ $order->time }}</b></p>
                            <p>Pickup Date: <b>{{ Carbon\Carbon::parse($order->date)->format('d/m/y') }}</b></p>

                            <p>Drop Off Time: <b>{{ $order->drop_time }}</b></p>
                            <p>Drop Off Date: <b>{{ \Carbon\Carbon::parse($order->drop_date)->format('d/m/y') }}</b></p>
                            <p>Package: <b>{{ $order->package }}</b></p>
                            <p>Mileage: <b>{{ $order->mileage }}</b></p>
                            <p>Cost: <b>£{{ number_format((float)$order->cost/100, 2, '.', '') }}</b></p>

                            <p>Pickup Contact & Number: <b>{{ $order->pickup_contact }}</b></p>
                            <p>Delivery Contact & Number: <b>{{ $order->delivery_contact }}</b></p>
                            <p>Delivery Information: <b>{{ $order->delivery_info }}</b></p>
                            <p>Size: <b>{{ $order->size }}</b></p>
                            <p>Weight: <b>{{ $order->weight }}</b></p>
                            <p>Notes: <b>{{ $order->notes }}</b></p>
                            <p>Confirmed No Dangerous Goods: <b>{{ ($order->confirm == 1) ? 'Yes' : 'No'}}</b></p>
                        </div>



                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->

@endsection
