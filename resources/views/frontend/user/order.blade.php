@extends('frontend.user.dashboard')
@section('profile')
<div class="dashboard-wrapper user-dashboard" style="padding: 0px">
            <div class="col-md-12">
                <div class="nav nav-tabs justify-content-center border-secondary mb-4 dashboard-menu" style="padding: 20px">
                    <a class="nav-item nav-link active" style="padding: 8px" data-toggle="tab" href="#tab-pane-1">Đặt lịch</a>
                    <a class="nav-item nav-link"style="padding: 8px" data-toggle="tab" href="#tab-pane-2">Đặt hàng</a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab-pane-1">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Người đăt</th>
                                        <th>Địa chỉ</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Thời gian làm việc</th>
                                        <th>Tổng hóa đơn</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($book))
                                        @foreach ($book as $key=>$value )
                                        <tr>
                                            <td>{{ $value->book_id }}</td>
                                            <td>{{ $shipping->shipping_name }}</td>
                                            <td>{{ $value->book_address }}</td>
                                            <td>{{ date('l d/m/Y',strtotime($value->book_date)).' - '. date('H:i',strtotime($value->book_time_start)) }}</td>
                                            <td>{{ date('H:i',strtotime($value->book_time_start)) .'-'. date('H:i',strtotime($value->book_time_end)) }}</td>
                                            <td>{{ number_format($value->book_total) }} <sup>đ</sup> </td>
                                            @switch($value->book_status)
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
                                            <td><a href="{{ route('home.account.book.details',$value->book_code) }}" class="btn btn-default">Xem chi tiết</a></td>
                                        </tr>
                                        @endforeach
                                        @else
                                            <tr><td>Bạn chưa có đơn đặt lịch nào!</td></tr>

                                    @endif

                                </tbody>
                            </table>
                        </div>

                            {{-- Đơn đặt hàng --}}
                    </div>
                    <div class="tab-pane fade" id="tab-pane-2">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Ngày đặt hàng</th>
                                        <th>Người nhận</th>
                                        <th>Tổng hóa đơn</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($order))
                                        @foreach ($order as $key=>$value )
                                        <tr>
                                            <td>{{ $value->order_id }}</td>
                                            <td>{{ $value->created_at }}</td>
                                            <td>{{ $shipping->shipping_name }}</td>
                                            <td>{{ number_format($value->order_total) }}<sup>đ</sup></td>

                                            @switch($value->order_status)
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


                                            <td><a href="{{ route('home.account.order.details',$value->order_code) }}" class="btn btn-default">Xem chi tiết</a></td>
                                        </tr>
                                        @endforeach

                                    @else
                                        <tr><td>Bạn chưa có đơn hàng nào!</td></tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
</div>

@endsection
