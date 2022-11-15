@extends('client.layouts.app')
@section('title', 'Home')
@section('content')

    <div id="header-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 410px;">
                <img class="img-fluid" src="{{ asset('client/img/guitar1.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        {{-- <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                            Order</h4> --}}
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Timeless Instrument</h3>
                        <a href="{{ route('client.shop') }}" class="btn btn-light py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item" style="height: 410px;">
                <img class="img-fluid" src="{{ asset('client/img/guitar2.jpg') }}" alt="Image">
                <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                    <div class="p-3" style="max-width: 700px;">
                        {{-- <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off Your First
                            Order</h4> --}}
                        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Get Loud</h3>
                        <a href="{{ route('client.shop') }}" class="btn btn-light py-2 px-3">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-prev-icon mb-n2"></span>
            </div>
        </a>
        <a class="carousel-control-next" href="#header-carousel" data-slide="next">
            <div class="btn btn-dark" style="width: 45px; height: 45px;">
                <span class="carousel-control-next-icon mb-n2"></span>
            </div>
        </a>
    </div>
    <div>
        <div class="container-fluid pt-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">HOT ITEMS</span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                @foreach ($totalQuantity as $item)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ $item->product->images->count() > 0 ? asset('upload/' . $item->product->images->first()->url) : 'upload/default.png' }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $item->product->name }}</h6>
                            <div class="d-flex justify-content-center">
                                @if ($item->product->sale > 0)
                                <h6>${{ $item->product->price - ($item->product->price * ($item->sale)/100) }}</h6><h6 class="text-muted ml-2"><del>${{ $item->product->price }}</del></h6>
                                @else
                                <h6>${{ $item->product->price }}</h6>   
                                @endif
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('client.products.show', $item->product->id) }}" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
 
        <div class="container-fluid pt-1">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">HOT SALE</span></h2>
            </div>
            <div class="row px-xl-5 pb-3">
                @foreach ($promoProducts as $item)
                <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                    <div class="card product-item border-0 mb-4">
                        <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                            <img class="img-fluid w-100" src="{{ $item->images->count() > 0 ? asset('upload/' . $item->images->first()->url) : 'upload/default.png' }}" alt="">
                        </div>
                        <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                            <h6 class="text-truncate mb-3">{{ $item->name }}</h6>
                            <div class="d-flex justify-content-center">
                                @if ($item->sale > 0)
                                <h6>${{ $item->price - ($item->price * ($item->sale)/100) }}</h6><h6 class="text-muted ml-2"><del>${{ $item->price }}</del></h6>
                                @else
                                <h6>${{ $item->price }}</h6>   
                                @endif
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between bg-light border">
                            <a href="{{ route('client.products.show', $item->id) }}" class="btn btn-sm text-dark p-0"><i
                                    class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        

    </div>

@endsection