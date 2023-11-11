@extends('frontend.layouts.blocks.app')
@section('content')
@php
    $cart = Cart::content();
    $total = 0;
    $coupon_code = "";
@endphp
<section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
            <form action=" {{ route('home.checkout.update',$shipping->id) }}" method="POST" class="billing-form">
                @csrf
                <h3 class="mb-4 billing-heading">Địa chỉ khách hàng</h3>
                <div class="row align-items-end">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="firstname">Firt Name</label>
                            <input type="text" class="form-control" placeholder="" name="first_name" value="{{ $first_name }}">
                        </div>
                        @error('first_name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" placeholder="" name="last_name" value="{{ $last_name }}">
                        </div>
                        @error('last_name')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <label class="form-label" for="country">Country</label>
                        <select name="city_id" id="city" class="select2 form-control choose city">
                            <option value="">--- Chọn Thành Phố ---</option>
                            @foreach ($city as $item)
                                @if($item->city_id == $shipping->city_id)
                                <option value="{{ $item->city_id }}" selected>{{ $item->city_name }}</option>
                                @else
                                <option value="{{ $item->city_id }}">{{ $item->city_name }}</option>
                            @endif
                            @endforeach
                        </select>
                        @error('city_id')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="province">Province</label>
                        <select name="province_id" id="province" class="select2 form-control choose province">
                        <option value="">--- Chọn Tỉnh ---</option>
                            @foreach ($province as $item)
                                @if($item->province_id == $shipping->province_id)
                                    <option value="{{ $item->province_id }}" selected>{{ $item->province_name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('province_id')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="form-label" for="province">Ward</label>
                        <select name="ward_id" id="ward" class="select2 form-control ward">
                            <option value="">--- Chọn Phường/Xã ---</option>
                            @foreach ($ward as $item)
                                @if($item->ward_id == $shipping->ward_id)
                                    <option value="{{ $item->ward_id }}" selected>{{ $item->ward_name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @error('ward_id')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="streetaddress">Street Address</label>
                            <input type="text" class="form-control" name="shipping_address" placeholder="House number and street name" value="{{ $shipping->shipping_address }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" class="form-control" name="shipping_phone" placeholder="" value="{{ $shipping->shipping_phone }}">
                    </div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailaddress">Email Address</label>
                        <input type="text" class="form-control" name="shipping_email" placeholder="" value="{{ $shipping->shipping_email }}">
                    </div>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-md-12">
                        <div class="form-group">
                        <label for="emailaddress">Notes</label>
                            <textarea name="shipping_notes" id="" cols="30" rows="10" class="form-control">{{ $shipping->shipping_notes }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mt-4">
                            <div class="radio">
                                <label class="mr-3"><input type="radio" name="optradio"> Create an Account? </label>
                                <label><input type="radio" name="optradio"> Ship to different address</label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 px-4">Xác nhận địa chỉ</button>
                </div>
            </form><!-- END -->
        </div>
        @if (Session::get('cart'))

        <div class="col-md-4">
            <div class="row mt-5 pt-3">
                <div class="product-checkout-details">
                    <div class="block">
                        <h4 class="widget-title">Tổng đơn hàng</h4>
                        @foreach ($cart as $key=>$value)
                            @php
                                $image = json_decode($value->options->image);
                                $subtotal = $value->price*$value->qty;
                                $total+=$subtotal;
                            @endphp
                            <div class="media product-card">
                                <a class="pull-left" href="">
                                <img class="media-object" src="{{ asset('uploads/products/medium'.$image[0]) }}" alt="Image" />
                                </a>
                                <div class="media-body">
                                <h4 class="media-heading"><a href="">{{$value->name}}</a></h4>
                                <p class="remove">{{ number_format($value->price).' '.'$'}} X {{ $value->qty }}</p>
                                <span class="price" >{{ number_format($value->price* $value->qty ).' '.'$'}}</span>
                                </div>
                            </div>
                        @endforeach
                        <div class="discount-code">
                            <p>Xem lại giỏ hàng ? <a data-toggle="modal" data-target="#coupon-modal" href="{{ route('home.show-cart')}}" style="color: lightblue">ở đây</a></p>
                         </div>

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
                                <p class="d-flex total-price" style="color: red;font-size: 12px">
                                    *Tổng sản phẩm phải có giá trị trên 200.000 VNĐ
                                    </p>
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
                    <div class="cart-detail p-3 p-md-4">
                        <h3 class="billing-heading mb-4">Phương thức thanh toán</h3>
                        @foreach ($payment as $valpay)
                            <div class="form-group">
                                <div class="col-md-12">
                                    <div class="radio">
                                        <label><input type="radio" name="payment_id" value="{{$valpay->payment_id}}" class="mr-2"> {{ $valpay->payment_method }}</label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @endif
        </div> <!-- .col-md-8 -->
      </div>
    </div>
  </section> <!-- .section -->

@endsection
