@extends('layouts.master')
@section('content')
  @foreach ($products as $product)
    <div class="col-md-6">
      <div class="row no-gutters shadow border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-info">
            @foreach ($product->categories as $category)
                {{ $category->name }}
            @endforeach
          </strong>
          <h5 class="mb-0">{{ $product->title }}</h5>
          <p class="mb-auto text-muted">{{ $product->subtitle }}</p>
          <strong class="mb-auto font-weight-bold h3 text-secondary">{{ $product->getPrice() }}</strong>
          <a href="{{ route('products.show', $product->slug) }}" class="btn btn-info">
            <i class="fa fa-eye pr-3" aria-hidden="true"></i>
            See details
          </a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <img src="{{ $product->image }}" alt="">
        </div>
      </div>
    </div>
  @endforeach
  <div class="container">
    {{ $products->appends(request()->input())->links() }}
  </div>
  
@endsection