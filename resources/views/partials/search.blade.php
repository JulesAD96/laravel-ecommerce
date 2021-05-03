<form action="{{ route("products.search") }}" class="d-flex mr-3">
    <div class="form-group mb-0 mr-1 ">
        <input type="search" placeholder="Search product" name="q" class="form-control"
            value="{{ request()->q ?? "" }}">
    </div>
    <button class="btn btn-info">
        <i class="fa fa-search" aria-hidden="true"></i>
    </button>
</form>