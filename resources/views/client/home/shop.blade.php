@extends('client.layouts.app')
@section('title', 'Home')
@section('content')
    <div class="row ">
        <div class="d-inline-flex" style="margin-left:40px">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Shop</p>
            <p class="m-0 px-2">/</p>
        </div>
    </div>
    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Products</span></h2>
        </div>
        <div class="row pb-3">
            <div class="col-md-4">
                <label for="amount">Sort</label>
                <form>
                    @csrf
                    <select name="sort" id="sort" class="form-control">
                        <option value="{{ Request::url() }}?sort_by=all">Sort by</option>
                        <option value="{{ Request::url() }}?sort_by=az">A-Z</option>
                        <option value="{{ Request::url() }}?sort_by=za">Z-A</option>
                        <option value="{{ Request::url() }}?sort_by=asc">Ascending Price</option>
                        <option value="{{ Request::url() }}?sort_by=desc">Descending Price</option>
                        <option value="{{ Request::url() }}?sort_by=sale">Hot Sale</option>
                        <option value="{{ Request::url() }}?sort_by=500">0-$499</option>
                        <option value="{{ Request::url() }}?sort_by=1k">$500-$999</option>
                        <option value="{{ Request::url() }}?sort_by=1k5">$999-$1499</option>
                        <option value="{{ Request::url() }}?sort_by=2k">$1500-$1999</option>
                        <option value="{{ Request::url() }}?sort_by=2kmore">$2000 or more</option>
                    </select>
                </form>
            </div>
        </div><br>

        <div class="row px-xl-5 pb-3">
            @foreach ($products as $item)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100"
                                src="{{ $item->images->count() > 0 ? asset('upload/' . $item->images->first()->url) : 'upload/default.png' }}"
                                alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $item->name }}</h6>
                            <div class="d-flex justify-content-center">
                                @if ($item->sale > 0)
                                    <h6>${{ $item->price - ($item->price * $item->sale) / 100 }}</h6>
                                    <h6 class="text-muted ml-2"><del>${{ $item->price }}</del></h6>
                                @else
                                    <h6>${{ $item->price }}</h6>
                                @endif
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('client.products.show', $item->id) }}" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            {{-- <a href="" class="btn btn-sm text-dark p-0"><i
                                class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a> --}}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        {{ $products->links() }}

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {

                $('#sort').on('change', function() {

                    var url = $(this).val();
                    if (url) {
                        window.location = url;
                    }
                    return false;
                });
            });

            

        </script>
    </div>

    <!-- Products End -->

@endsection
