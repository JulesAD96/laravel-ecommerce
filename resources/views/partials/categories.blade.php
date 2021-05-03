<div class="w-100">
    <div class="py-1 mb-1 border bg-light">
        <nav class="d-flex justify-content-between ">
          @foreach (App\Category::all() as $category)
            <a class="p-2 text-muted" href="{{ route("products.index", ["category" => $category->slug]) }}"> {{ $category->name }} </a>
          @endforeach
        </nav>
    </div>
</div>