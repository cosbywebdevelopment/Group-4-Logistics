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
                    <th style="width:100px">Vehicle</th>
                    <th style="width:100px">Pickup</th>
                    <th style="width:100px">Drop Off</th>
                    <th style="width:75px">Time</th>
                    <th style="width:100px">Date</th>
                    <th style="width:100px">Package</th>
                    <th style="width:100px">Mileage</th>
                    <th style="width:100px">Cost</th>
                    <th style="width:100px" class="text-wrap">Payment ID</th>
                    <th style="width:100px">Created At</th>
                    <th style="width:100px">Action</th>

                </tr>
                </thead>
                <tbody>

                @foreach($orders as $order)
                    <form method="post" action="/admin/dashboard/frontend/deleteOrder/{{ $order->id }}">
                        @method('DELETE')
                        @csrf
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
                            <td>{{ \Carbon\Carbon::parse($order->created_at)->diffForHumans() }}</td>
                            <td><button type="submit" class="btn btn-danger">Delete</button></td>
                        </tr>
                    </form>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection
