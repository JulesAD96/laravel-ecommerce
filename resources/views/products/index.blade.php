@extends('layouts.master')
@section('content')
@include('partials.slider')
@include('partials.categories')
<div class="row mb-2 mt-2">
      @foreach ($products as $product)
        <div class="col-md-4">
          <div class="shadow border rounded overflow-hidden flex-md-row mb-4 shadow-sm">
            <div class="w-100">
              <img class="product__image" src="{{ $product->image }}" alt="{{ $product->title }}">
            </div>
            <div class="col p-4">
              <strong class="d-inline-block mb-2 text-info">
                @foreach ($product->categories as $category)
                    {{ $category->name }}
                @endforeach
              </strong>
              <h5 class="mb-0">{{ $product->title }}</h5>
              <p class="mb-auto text-muted">{{ $product->subtitle }}</p>
              <strong class="mb-auto font-weight-bold h3 text-secondary">{{ $product->getPrice() }}</strong>
              <a href="{{ route('products.show', $product->slug) }}" class="btn btn-info btn-block mt-3">
                <i class="fa fa-eye pr-3" aria-hidden="true"></i>
                See details
              </a>
            </div>
            
          </div>
        </div>
      @endforeach
      <div class="container">
        {{ $products->appends(request()->input())->links() }}
      </div>
</div>
  
  
@endsection