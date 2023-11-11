@extends('frontend.layouts.blocks.app')
@section('content')
<section class="ftco-section ftco-cart">
    @if (session('msg'))
    <div class="alert alert-{{session('style')}}">
        {{ session('msg') }}
    </div>
    @endif
    <div class="container">
        @php
            $cart = Cart::content();
			$total = 0;
            $coupon_code = "";
        @endphp
        <div class="row">

        <div class="col-md-12 ftco-animate">
            <div class="cart-list">
                <table class="table">
                    <thead class="thead-primary">
                      <tr class="text-center">
                        <th>&nbsp;</th>
                        <th>&nbsp;</th>
                        <th>Tên</th>
                        <th>Giá</th>
                        <th>Cân lặng</th>
                        <th>Tổng tiền</th>
                      </tr>
                    </thead>
                    @if (Session::get('cart')==true)
                        <tbody>
                            @foreach ($cart as $key=>$value)
                            @php
                                $image = json_decode($value->options->image);
                                    $subtotal = $value->price*$value->qty;
                                    $total+=$subtotal;
                            @endphp
                            <tr class="text-center">
                                <td class="product-remove"><a href="#"><span class="ion-ios-close"></span></a></td>

                                <td >
                                    <div class="product-info">
                                    <img width="80" src="{{ asset('uploads/products/medium'.$image[0]) }}" alt="" />
                                  </div>
                                   </td>

                                <td class="product-name">
                                    <h3>{{ $value->name }}</h3>
                                    <p>{{ $value->id }}</p>
                                </td>

                                <td class="price cart_price">{{ number_format($value->price).' '.'$'}}</td>

                                <td class="quantity cart_quantity">
                                    <div class="input-group mb-3 cart_quantity_button">
                                        <button type="button" class="quantity-left-minus btn cart_quantity_down"  data-type="minus" data-field="">
                                            <i class="ion-ios-remove">-</i>
                                        </button>

                                        <input type="text" name="weight" class="quantity input-number" value="{{ $value->qty }}" min="1" max="100">

                                        <button type="button" class="quantity-right-plus btn cart_quantity_up" data-type="plus" data-field="">
                                            <i class="ion-ios-add">+</i>
                                        </button>
                                </div>
                                </td>

                                <td class="total cart_total">{{ number_format($value->price* $value->qty ).' '.'$'}}</td>
                            </tr><!-- END TR-->

                            @endforeach

                        </tbody>

                    @else
                        <tbody><tr class="text-center"><td colspan="5">Chưa có mặt hàng nào trong giỏ hàng vui lòng thêm sản phẩm</td></tr></tbody>
                    @endif
                  </table></div>
              </div>
              </div>

    <div class="row justify-content-end">
        <div class="col-lg-6 mt-5 cart-wrap ftco-animate">
                <div class="cart-total mb-3">
                    <h3>Địa chỉ giao hàng</h3>
                    <p>{{ Auth::user()->address }}
                    <a href="{{ route('home.checkout') }}" class="m-4">Change <i class="ion-ios-arrow-forward ml-2"></i></a></p>
                    <h3>Mã giảm giá</h3>
                    <p>Nhập mã giảm giá nếu có !</p>
                    <form action="{{ route('home.coupon') }}" class="info" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Mã giảm giá</label>
                            <input type="text" class="form-control text-left px-3" name="coupon_code" value="{{ old('coupon_code') }}">
                        </div>
                    <p><button type="submit" class="btn btn-primary py-3 px-4">Áp dụng mã giảm giá</button></p>
                    </form>
                </div>
        </div>
        <div class="col-lg-6 mt-5 cart-wrap ftco-animate">
            <form action="{{ route('home.save-cart') }}" method="POST">

            @csrf
                <div class="product-checkout-details">
                    <div class="block">
                    <h3>Cart Totals</h3>
                        <ul class="summary-prices">
                            <li>
                                <span>Tổng tiền hàng</span>
                                <span class="total-product">{{ Cart::subtotal(0) }} <sup>đ</sup> </span>
                            </li>
                            <li>
                                <span>Phí vận chuyển</span>
                                <span>0 <sup>đ</sup></span>
                            </li>
                            <li>
                                <span>Khuyến mãi</span>
                                <span>
                                    @if(Session::get('coupon'))
                                        @php
                                            $coupon = Session::get('coupon');
                                        @endphp
                                        @foreach ($coupon as $key=>$cou )
                                            @php
                                                $coupon_code = $cou['coupon_code'];
                                            @endphp
                                            @if($cou['coupon_method'] == 1)
                                                @php
                                                    $total_coupon= $cou['coupon_number'];
                                                @endphp
                                                {{ number_format($total_coupon,0,',','.') }} <sup>đ</sup>
                                            @elseif($cou['coupon_method']==0)
                                                @php
                                                    $total_coupon= $total *$cou['coupon_number']/100 ;
                                                @endphp
                                                {{ number_format($total_coupon,0,',','.') }} <sup>đ</sup>

                                            @endif
                                        @endforeach
                                    @else
                                        @php
                                            $total_coupon = 0;
                                        @endphp
                                    @endif
                                </span>
                            </li>
                        </ul>
                        <div class="summary-total">
                            <span>Tổng thanh toán</span>
                        @php
                            $total =$total - $total_coupon;
                        @endphp
                        <span class="total-cart">{{ number_format($total,0,',','.') }} <sup>đ</sup></span>
                        </div>
                    </div>

                    </p>
                </div>

                <div class="col-md-12">
                    <h3 class="billing-heading mb-4">Phương thức thanh toán</h3>
                    @foreach ($payment as $valpay)
                        <div class="form-group">
                            <div class="col-md-12">
                                <div class="radio">
                                    <label><input type="radio" name="payment_id" value="{{$valpay->payment_id}}" class="mr-2"> {{ $valpay->payment_method }}</label>
                                    <input type="hidden" name="coupon_code" value="{{ $coupon_code }}">
                                    <input type="hidden" name="order_total" value="{{ $total }}">

                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
                <p><button type="submit" class="btn btn-primary py-3 px-4">Place Order</button></p>
            </form>
        </div>
    </div>
        </div>

    </div>
    </div>
</section>
<script>
    $(document).ready(function(){
        $(".cart_quantity_up").click(function(){
            var product_id = $(this).closest("tr").find(".product-name p").text();
            var qty= Number($(this).closest('.cart_quantity_button').find('input').val());
            var price = $(this).closest("tr").find(".cart_price").text();
            var price = Number(price.replace(/[^0-9]/g, ''));
            qty+=1;
            var total = qty*price;
            $(this).closest(".cart_quantity_button").find("input").val(qty);
            $(this).closest("tr").find(".cart_total").text(total);
            $.ajax({
            method:"GET",
            url: "{{ route('home.quantity-change') }}",
            data:{
                qty:qty,
                product_id:product_id,
                // down:down,
            },
            success : function(html){
                window.setTimeout(function() {
                    location.reload();
                },3000);
            },
        });
        });

        $(".cart_quantity_down").click(function(){
            var product_id = $(this).closest("tr").find(".product-name p").text();
            var qty= Number($(this).closest('.cart_quantity_button').find('input').val());
            var price = $(this).closest("tr").find(".cart_price").text();
            var price = Number(price.replace(/[^0-9]/g, ''));
            qty-=1;
            var total = qty*price;
         if (qty <= 0) {
            $(this).closest("tr").remove();
         }else{
            $(this).closest(".cart_quantity_button").find("input").val(qty);
            $(this).closest("tr").find(".cart_total").text(total);
         }
         $.ajax({
            method:"GET",
            url: "{{ route('home.quantity-change') }}",
            data:{
                qty:qty,
                product_id:product_id,
                // down:down,
            },
            success : function(html){
                window.setTimeout(function() {
                    location.reload();
                },3000);
            },
        });
        });

    });
    </script>
@endsection
