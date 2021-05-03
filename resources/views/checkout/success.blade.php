@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="jumbotron jumbotron-fluid mt-1">
                <div class="container text-center">
                  <h1 class="display-4">Thanks </h1>
                  <p class="lead">Your order has been successfully registered, we will contact you for a delivery. .
                      <br>
                    <a class="btn btn-primary mt-2" href="{{ route("products.index") }}">Continue Shopping</a>
                  </p>
                </div>
              </div>
        </div>
    </div>
@endsection