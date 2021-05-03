<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.6">
    <title>Blog Template · Bootstrap</title>

    @yield('extra-script')
    @yield('extra-meta')
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset("styles/styles.css") }}">
    
  </head>
  <body>
    <div class="container">
  <header class="blog-header py-3 border-bottom">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="{{ route("cart.index") }}">
          <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
          <span class="badge badge-pill badge-info pt-1 pl-2 pr-2 pb-1">
              {{ Cart::count() }}
          </span>
        </a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{ route("products.index") }}">🛍️ My-Biz</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        @include('partials.search')
        <ul class="list-group">
            @include('partials.auth')
        </ul>
      </div>
    </div>
  </header>

  @if (session("success"))
      <div class="alert alert-success">
        {{ session("success") }}
      </div>
  @endif

  @if (session("danger"))
    <div class="alert alert-danger">
      {{ session("danger") }}
    </div>
  @endif

  @if (count($errors))
      <div class="alert alert-danger">
        <ul class="mt-0 mb-0">
          @foreach ($errors->all() as $error)
              <li> {{ $error }} </li>
          @endforeach
        </ul>
      </div>
  @endif

  @if (request()->input('q'))
      <div class="mt-2">
          <h5>Result <span class="text-info">{{ $products->total() }}</span> for request "{{ request()->input("q") }}" </h5>
      </div>
  @endif

  @yield('content')
  
</div>


<footer class="blog-footer">
  <p><a href="https://getbootstrap.com/">
  </a> - 🛒 Application E-Commerce avec Laravel 6</p>
  <p>
    <a href="#">Revenir en haut</a>
  </p>
</footer>
@yield('extra-js')
</body>
</html>
