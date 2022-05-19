@extends('backend.layouts.app')

@section('title', __('User Management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Booking Ref: <b>{{ $order->ref }}</b></h2>
        </div>
        <div class="card-body">
            <p>Email: <b>{{ $order->email }}</b></p>
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
    </div>


@endsection
