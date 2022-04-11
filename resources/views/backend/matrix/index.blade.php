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
            <p class="card-text">You can change the values below.</p>

            <table class="table table-responsive-sm">
                <thead>
                <tr>
                    <th>Type</th>
                    <th style="width: 100px">Length</th>
                    <th style="width: 100px">Height</th>
                    <th style="width: 100px">Width</th>
                    <th style="width: 120px">Pallets</th>
                    <th style="width: 120px">Max Weight</th>
                    <th style="width: 120px">Min Charge</th>
                    <th style="width: 120px">Per Mile</th>
                    <th style="width: 120px">After 5</th>
                    <th style="width: 120px">At weekends</th>
                    <th style="width: 120px">Action</th>
                </tr>
                </thead>
                <tbody>

                @foreach($product as $products)
                    <form method="post" action="/admin/dashboard/frontend/update/{{ $products->id }}">
                        @method('PATCH')
                        @csrf
                        <tr>
                            <td><input name="type" class="form-control" value="{{ $products->type }}"></td>
                            <td><input name="length" class="form-control" value="{{ $products->length }}"></td>
                            <td><input name="height" class="form-control" value="{{ $products->height }}"></td>
                            <td><input name="width" class="form-control" value="{{ $products->width }}"></td>
                            <td><input name="pallets" class="form-control" value="{{ $products->pallets }}"></td>
                            <td><input name="max_weight" class="form-control" value="{{ $products->max_weight }}"></td>
                            <td><input name="min_charge" class="form-control" value="{{ $products->min_charge }}"></td>
                            <td><input name="per_mile" class="form-control" value="{{ $products->per_mile }}"></td>
                            <td><input name="collection_5" class="form-control" value="{{ $products->collection_5 }}"></td>
                            <td><input name="collection_weekend" class="form-control" value="{{ $products->collection_weekend }}"></td>
                            <td><button type="submit" class="btn btn-primary">Update</button></td>
                        </tr>
                    </form>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
@endsection
