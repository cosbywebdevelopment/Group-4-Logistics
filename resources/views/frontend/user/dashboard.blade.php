@extends('frontend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <a href="/#about" class="btn btn-success mb-4">Book a Delivery</a>
                <x-frontend.card>
                    <x-slot name="header">
                        Your Deliveries
                    </x-slot>

                    <x-slot name="body">
                        <table class="table table-responsive-sm">
                            <thead>
                            <tr>
                                <th>Booking</th>
                                <th style="">Pickup</th>
                                <th style="">Drop Off</th>
                                <th style="">Time</th>
                                <th style="">Date</th>
                                <th style="">Package</th>
                                <th style="">Mileage</th>
                                <th style="">Cost</th>
                                <th style="">Payment ID</th>
                                <th style="">Created At</th>

                            </tr>
                            </thead>
                            <tbody>

                            @foreach($orders as $order)
                                <tr>
                                    <td><a href="{{ route('frontend.user.booking', $order->id) }}" class="btn btn-dark">Show</a></td>
                                    <td>{{ $order->pickup }}</td>
                                    <td>{{ $order->drop_off }}</td>
                                    <td>{{ $order->time }}</td>
                                    <td>{{ $order->date }}</td>
                                    <td>{{ $order->package }}</td>
                                    <td>{{ $order->mileage }}</td>
                                    <td>{{ number_format((float)$order->cost/100, 2, '.', '') }}</td>
                                    <td>{{ $order->payment_method }}</td>
                                    <td>{{ $order->created_at }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-10-->
        </div><!--row-->
    </div><!--container-->
@endsection
