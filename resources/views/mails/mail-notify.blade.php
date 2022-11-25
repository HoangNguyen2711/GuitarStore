<div>
    <div class="col-lg-4">
        <div class="card border-secondary mb-5">
            <div class="card-header bg-secondary border-0">
                <h4 class="font-weight-semi-bold m-0">Order Total</h4>
            </div>
            <div class="card-body">
                <h5 class="font-weight-medium mb-3">Products</h5>
                @foreach ($data['cart']->products as $item)
                    <div class="d-flex justify-content-between">
                        <p> {{ $item->product_quantity }} x {{ $item->product->name }}</p>
                        <p
                            style="
                       {{ $item->product->sale ? 'text-decoration: line-through' : '' }};
                       ">
                            ${{ $item->product_quantity * $item->product->price }}
                        </p>
                        @if ($item->product->sale)
                            <p style="
                       ">
                                ${{ $item->product_quantity * $item->product->sale_price }}
                            </p>
                        @endif
                    </div>
                @endforeach
                <hr class="mt-0">
                <div class="d-flex justify-content-between mb-3 pt-1">
                    <h6 class="font-weight-medium">Subtotal</h6>
                    <h6 class="font-weight-medium total-price" data-price="{{ $data['cart']->total_price }}">
                        ${{ $data['cart']->total_price }}</h6>

                </div>
                <div class="d-flex justify-content-between">
                    <h6 class="font-weight-medium">Shipping</h6>
                    <h6 class="font-weight-medium shipping" data-price="5">$5</h6>
                    <input type="hidden" value="5" name="ship">

                </div>
                @if (session('discount_amount_price'))
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Coupon </h6>
                        <h6 class="font-weight-medium coupon-div"
                            data-price="{{ session('discount_amount_price') }}">
                            ${{ session('discount_amount_price') }}</h6>
                    </div>
                @endif

            </div>
            <div class="card-footer border-secondary bg-transparent">
                <div class="d-flex justify-content-between mt-2">
                    <h5 class="font-weight-bold">Total</h5>
                    <h5 class="font-weight-bold total-price-all">{{ $data['order']->total }}</h5>
                    <input type="hidden" id="total" value="" name="total">
                </div>
            </div>
        </div>
    </div>
</div>

