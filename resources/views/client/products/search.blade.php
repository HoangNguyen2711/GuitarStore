@extends('client.layouts.app')
@section('title', 'Search')
@section('content')

    <!-- Products Start -->
    <div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Search</span></h2>
        </div>
        <div class="row px-xl-5 pb-3">
            @foreach ($search as $item)
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="card product-item border-0 mb-4">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{ $item->images->count() > 0 ? asset('upload/' . $item->images->first()->url) : 'upload/default.png' }}" alt="">
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
        
    </div>

    <!-- Products End -->

@endsection