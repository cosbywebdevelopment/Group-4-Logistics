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
                    <th style="width:100px">Email</th>
                    <th style="width:100px">Pickup</th>
                    <th style="width:100px">Drop Off</th>
                    <th style="width:75px">Pickup Time</th>
                    <th style="width:100px">Pickup Date</th>
                    <th style="width:75px">Drop Time</th>
                    <th style="width:100px">Drop Date</th>
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
                    <form name="delete-item" method="post" action="/admin/dashboard/frontend/deleteOrder/{{ $order->id }}">
                        @method('DELETE')
                        @csrf
                        <tr>
                            <td>{{ $order->email }}</td>
                            <td>{{ $order->pickup }}</td>
                            <td>{{ $order->drop_off }}</td>
                            <td>{{ $order->time }}</td>
                            <td>{{ Carbon\Carbon::parse($order->date)->format('d/m/y') }}</td>
                            <td>{{ $order->drop_time }}</td>
                            <td>{{ Carbon\Carbon::parse($order->drop_date)->format('d/m/y') }}</td>
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
