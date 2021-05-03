@extends('layouts.master')

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header h5"> Oders Passed </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Price</th>
                            <th scope="col">Product Quantity</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth()->user()->orders as $order)
                                @foreach (unserialize($order->products) as $product)
                                <tr>
                                    <th scope="row"> {{ $loop->iteration }} </th>
                                    <td>{{ $product[0] }}</td>
                                    <td>{{ getPrice($product[1]) }}</td>
                                    <td>{{ $product[2] }}</td>
                                </tr>
                                @endforeach
                            @endforeach
                          <tr>
                            <td colspan="3" class="bg-info text-white text-center h4">Total Price</td>
                            <td class="bg-success text-white text-center h4"> {{ getPrice($order->amount) }} </td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
