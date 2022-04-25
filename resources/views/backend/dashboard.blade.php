@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Orders</h5>
        </div>
        <div class="card-body">

            <table class="table table-responsive-sm">
                <thead>
                <tr>
                    <th>Vehicle</th>
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
                            <td>{{ $order->type }}</td>
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

        </div>
    </div>
@endsection
