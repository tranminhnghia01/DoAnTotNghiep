@extends('frontend.user.dashboard')
@section('profile')
<div class="dashboard-wrapper user-dashboard">
    @if (session('msg'))
<div class="alert alert-{{session('style')}}">
    {{ session('msg') }}
</div>
@endif
    <form action="" method="POST" class="checkout-form">
        @csrf
        <div class="product-checkout-details">
            <div class="block">
               <div class="summary-prices"style="padding: 0px" >
                <ul style="margin: 0px">
                    <li><span style="color: #888; font-size: 14px">Địa chỉ</span></li>
                    <li><input style=" font-size: 14px; margin-left: 10px; border: none;width: 100%;outline: none" readonly  value="{{ $book_details['book_address'] }}" name="book_address"></li>
                </ul>
               </div>
               <div class="summary-prices"style="padding: 0px" >
                <ul style="margin: 0px">
                        <li><span style="color: #888; font-size: 14px">Ngày đặt lịch</span></li>
                        <li><input style=" font-size: 14px; margin-left: 10px; border: none ;outline: none" readonly  value="{{date('l d-m-Y', strtotime($book_details['book_date']))}}" name="book_date"></li>
                    </ul>
               </div>
               <div class="summary-prices"style="padding: 0px" >
                <ul style="margin: 0px">
                        <li><span style="color: #888; font-size: 14px">Thời lượng</span></li>
                        <li><input style=" font-size: 14px; margin-left: 10px; border: none ;outline: none" readonly  value="{{ $book_details->book_time_total.'h, '.  date('H:i',strtotime($book_details->book_time_start)) .' đến '.  date('H:i',strtotime($book_details->book_time_end)) }}" name="book_time"></li>
                    </ul>
                </div>
                <div class="summary-prices"style="padding: 0px" >
                <ul style="margin: 0px">
                        <li><span style="color: #888; font-size: 14px">Ghi chú</span></li>
                        <li><input style=" font-size: 14px; margin-left: 10px; border: none ;outline: none; width: 100%;" readonly value="{{ $book_details['book_notes'] }}" name="book_notes"></li>
                    </ul>
                </div>
            </div>
         </div>
    </form>


    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Tên người đặt</th>
                    <th>Ngày đặt</th>
                    <th>Thời gian làm việc</th>
                    <th>Tổng hóa đơn</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($book_details))
                    <tr>
                        <td>{{ $book_details->book_code }}</td>
                            <td>{{ $shipping->shipping_name }}</td>
                            <td>{{ date('l d/m/Y',strtotime($book_details->book_date)).' - '. date('H:i',strtotime($book_details->book_time_start)) }}</td>
                            <td>{{ date('H:i',strtotime($book_details->book_time_start)) .'-'. date('H:i',strtotime($book_details->book_time_end)) }}</td>
                            <td>{{ number_format($book_details->book_total) }} <sup>đ</sup> </td>
                            @switch($book_details->book_status)
                                @case(1)
                                    <td><span class="label label-warning">Đang đợi xác nhận</span></td>
                                    @break
                                @case(2)
                                    <td><span class="label label-primary">Đã xác nhận </span></td>
                                    @break
                                @case(3)
                                    <td><span class="label label-danger">Đã hủy</span></td>
                                    @break
                                @default
                                    <td><span class="label label-success">Hoàn thành</span></td>
                            @endswitch
                            <td>
                                <div class="btn-group" role="group">
                                    <form >
                                        @csrf

                                        @if ($book_details->book_status == 4)
                                    <button type="button"  class="btn btn-default"><i class="tf-ion-close" aria-hidden="true"> Đánh_giá</i></button>
                                    @else
                                        <button type="button" class="btn btn-default destroy-book" data-book-code="{{ $book_details->book_code }}"><i class="tf-ion-close" aria-hidden="true">Hủy</i></button>
                                    @endif
                                    </form>

                                </div>
                              </td>
                    </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>

@endsection
