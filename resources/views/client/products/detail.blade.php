@extends('client.layouts.app')
@section('title', 'Product Detail')
@section('content')
    <!-- Page Header Start -->
    <div class="row" style="margin-left: 50px">
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Shop</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Product details</p>
        </div>
    </div>
    <!-- Page Header End -->
    @if (session('message'))
        <h2 class="" style="text-align: center; width:100%; color:rgb(0, 255, 8)"> {{ session('message') }}</h2>
    @endif

    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <form action="{{ route('client.carts.add') }}" method="POST" class="row px-xl-5">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="col-lg-5 pb-5">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner border">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="{{ $product->image_path }}" alt="Image">
                        </div>

                    </div>
                    {{-- <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a> --}}
                </div>
            </div>

            <div class="col-lg-7 pb-5">
                <h3 class="font-weight-semi-bold">{{ $product->name }} <input class="rating" value="{{ $product->averageRating }}" data-size="sm" readonly>
                </h3>
                <div class="d-flex mb-3">

                </div>
                <h3 class="font-weight-semi-bold mb-4">
                    @if ($product->sale > 0)
                        Price: ${{ $product->price - ($product->price * $product->sale) / 100 }}
                        <del>${{ $product->price }}</del>
                    @else
                        ${{ $product->price }}
                    @endif
                </h3>


                <div class=" mb-4">

                    <form>
                        @if ($product->quantity > 0)
                            <p class="text-dark font-weight-medium mb-0 mr-5">Quantity: {{ $product->quantity }}</p>
                            {{-- <p class="pd-5">Quantity: {{ $size->quantity }}</p> --}}
                            <div class="d-flex align-items-center mb-4 pt-2">
                                {{-- <div class="input-group quantity mr-3" style="width: 130px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control bg-secondary text-center" value="1">
                                        <div class="input-group-btn">
                                            <button  class="btn btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div> --}}
                                <button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> Add To
                                    Cart</button>
                            </div>
                        @else
                            <p>Sold out</p>
                        @endif
                    </form>


                </div>


                <div class="d-flex pt-2">
                    {{-- <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p> --}}
                    <div class="d-inline-flex">
                        {{-- <a class="text-dark px-2" href="">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a class="text-dark px-2" href="">
                            <i class="fab fa-pinterest"></i>
                        </a> --}}
                    </div>
                </div>
            </div>
        </form>
        <div class="row px-xl-5">
            <div class="col">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                    <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">Description</a>
                    <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">Reviews</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="tab-pane-1">
                        {!! $product->description !!}
                    </div>

                    <div class="tab-pane fade" id="tab-pane-3">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="mb-4">Reviews for {{ $product->name }}</h4>
                                @foreach ($product->ratings as $review)
                                    <div class="media mb-4">
                                        <img src="{{ $review->user->image_path }}" alt="Image"
                                            class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>{{ $review->user->name }}<small> -
                                                    <i>{{ $review->created_at->format('d-m-Y, H:i:s') }}</i></small></h6>
                                            <div class="text-primary">
                                                <input class="rating" value="{{ $review->rating }}" data-size="sm" readonly>
                                                <p>Commented: {{ $review->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container-fluid py-5">
            <div class="text-center mb-4">
                <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
            </div>
            <div class="row px-xl-5">
                <div class="col">
                    <div class="owl-carousel related-carousel">
                        @foreach ($related as $item)
                        <div class="card product-item border-0">
                            <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                <img class="img-fluid w-100" src="{{ $item->product->image_path }}" alt="">
                            </div>
                            <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                <h6 class="text-truncate mb-3">{{ $item->product->name }}</h6>
                                <div class="d-flex justify-content-center">
                                    @if ($item->product->sale > 0)
                                    <h6>${{ $item->product->price - ($item->product->price * $item->product->sale) / 100 }}</h6>
                                    <h6 class="text-muted ml-2"><del>${{ $item->product->price }}</del></h6>
                                @else
                                    <h6>${{ $item->product->price }}</h6>
                                @endif
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between bg-light border">
                                <a href="{{ route('client.products.show', $item->product->id) }}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                            </div>
                        </div>
                        @endforeach

                        

                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $(".rating").rating();
            $('.clear-rating').remove();
        });
    </script>
@endsection
