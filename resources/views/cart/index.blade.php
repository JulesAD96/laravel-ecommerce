@extends('layouts.master')

@section('extra-meta')
    <meta name="csrf-token" content='{{ csrf_token() }}'>
@endsection

@section('content')
    @if (Cart::count())
    <div class="px-4 px-lg-0">
        <div class="pb-5">
          <div class="container">
            <div class="row">
              <div class="col-lg-12 p-5 bg-white rounded shadow mb-5">
      
                <!-- Shopping cart table -->
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col" class="border-0 bg-light">
                          <div class="p-2 px-3 text-uppercase">Product</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Price</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Quantity</div>
                        </th>
                        <th scope="col" class="border-0 bg-light">
                          <div class="py-2 text-uppercase">Remove</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::content() as $product)
                            <tr>
                                <th scope="row">
                                <div class="p-2">
                                    <img src="{{ $product->model->image }}" alt="" width="70" class="img-fluid rounded shadow-sm">
                                    <div class="ml-3 d-inline-block align-middle">
                                    <h5 class="mb-0"> 
                                        <a href="#" class="text-dark d-inline-block">{{ $product->model->title }}</a>
                                    </h5>
                                    <span class="text-muted font-weight-normal font-italic">Category: Fashion</span>
                                    </div>
                                </div>
                                <td class="align-middle"><strong>{{ getPrice($product->subtotal()) }}</strong></td>
                                <td class="align-middle border-0">
                                    <select name="qty" data-id="{{ $product->rowId }}" class="custom-select" id="qty">
                                      @for ($i = 0; $i < 10; $i++)
                                        <option {{ $i == $product->qty ? "selected" : "" }} value="{{ $i }}"> {{ $i }} </option>
                                      @endfor
                                    </select>
                                </td>
                                <td class="align-middle text-center">
                                    <form action="{{ route("cart.destroy", ["rowId" => $product->rowId]) }}" method="post">
                                        @csrf
                                        @method("DELETE")
                                        <button href="#" class="btn-sm btn btn-danger text-dark"><i class=" text-white fas fa-trash"></i></button>
                                    </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
                <!-- End -->
            </div>
            </div>
    
            <div class="row py-5 p-4 bg-white rounded shadow-sm">
              <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
                <div class="p-4">
                  <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
                  <div class="input-group mb-4 border rounded-pill p-2">
                    <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
                    <div class="input-group-append border-0">
                      <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
                    </div>
                  </div>
                </div>
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
                <div class="p-4">
                  <p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
                  <textarea name="" cols="30" rows="2" class="form-control"></textarea>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
                <div class="p-4">
                <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
                <ul class="list-unstyled mb-4">
                    <li class="d-flex justify-content-between py-3 border-bottom">
                        <strong class="text-muted">Order Subtotal </strong>
                        <strong>{{ getPrice(Cart::subtotal()) }}</strong>
                    </li>
                    {{-- <li class="d-flex justify-content-between py-3 border-bottom">
                        <strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong>
                    </li> --}}
                    <li class="d-flex justify-content-between py-3 border-bottom">
                        <strong class="text-muted">Tax</strong><strong>{{ getPrice(Cart::tax()) }}</strong>
                    </li>
                    <li class="d-flex justify-content-between py-3 border-bottom">
                        <strong class="text-muted">Total</strong>
                        <h5 class="font-weight-bold">{{ getPrice(Cart::total()) }}</h5>
                    </li>
                </ul>
                <a href="{{ route("checkout.index") }}" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    @else
        <div class="col-md-12">
            <div class="alert alert-info">
                Your Shopping cart is empty 
            </div>
        </div>
    @endif
@endsection

@section('extra-js')
    <script>
        var qty = document.querySelectorAll('#qty');
        Array.from(qty).forEach((element) => {
        element.addEventListener('change', function () {
            var rowId = element.getAttribute('data-id');
            var token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch(`/cart/${rowId}`,
                {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json, text-plain, */*",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-TOKEN": token
                    },
                    method: 'post',
                    body: JSON.stringify({
                        qty: this.value
                    })
            }).then((data) => {
                console.log(data);
                location.reload();
            }).catch((error) => {
                console.log(error);
            });
        });
    });
    </script>
@endsection