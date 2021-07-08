@extends('layouts.master')

@section('content')
@include('partials.categories')
<div class="row mb-2 mt-2">
  <div class="col-md-12">
    <div class="border rounded d-flex flex-wrap shadow-sm">
      <div class="">
        <img class="w-100" src="{{ $product->image }}" alt="">
      </div>
      <div class="col p-4">
        <h5 class="mb-0">{{ $product->title }}</h5>
        <hr>
        <p class="mb-auto text-muted">{{ $product->description }}</p>
        <strong class="mb-auto font-weight-normal text-info font-weight-bold">{{ $product->getPrice() }}</strong>
        <form action="{{ route("cart.store") }}" method="post" class="mt-3">
          @csrf
          <input type="hidden" name="product_id" value="{{ $product->id }}">
          <button class="btn btn-dark">Add to card</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection