@extends('backend.layouts.app')

@section('title', __('User Management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Matrix Management
        </div>
        <div class="card-body">
            <h5 class="card-title">Matrix Options</h5>
            <p class="card-text">You can change the options below.</p>

            <table class="table table-responsive-sm">
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Length</th>
                    <th>Height</th>
                    <th>Width</th>
                    <th>Pallets</th>
                    <th>Max Weight</th>
                    <th>Min Charge</th>
                    <th>Per Mile</th>
                    <th>Collection After 5</th>
                    <th>Collection at weekends</th>
                </tr>
                </thead>
                <tbody>
                @foreach($product as $products)
                    <tr>
                        <td>{{ $products->type }}</td>
                        <td>{{ $products->length }}</td>
                        <td>{{ $products->height }}</td>
                        <td>{{ $products->width }}</td>
                        <td>{{ $products->pallets }}</td>
                        <td>{{ $products->max_weight }}</td>
                        <td>{{ $products->min_charge }}</td>
                        <td>{{ $products->per_mile }}</td>
                        <td>{{ $products->collection_5 }}</td>
                        <td>{{ $products->collection_weekend }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
@endsection
