@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Hóa đơn</h5>
            <!-- Table with stripped rows -->
            <div class="table-responsive">
                <table class="table datatable" style="text-align: center">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã hóa đơn</th>
                            <th>Mã đơn lịch</th>
                            <th>Số buổi đã hoàn thành</th>
                            <th>HTTT</th>
                            <th>Hóa đơn gốc</th>
                            <th>Thanh toán</th>
                            <th>Hoàn trả</th>
                            <th>Xem nhanh</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if (!empty($book)) --}}
                            @foreach ($book as $key=>$value )
                            <tr>
                                <td>{{ $key+1}}</td>
                                <td>{{ $value->history_id}}</td>
                                <td>{{ $value->name }}</td>
                                    @php
                                        $date =  explode(",",$value->book_date);
                                    @endphp

                                <td>{{ $value->date_finish }} / {{  count($date)-$value->history_previous_date }}</td>
                                <td>
                                    @if ($value->payment_id == 1)
                                        <span class="badge border-primary border-1 text-primary">Tiền mặt</span>
                                    @else
                                        <span class="badge border-success border-1 text-success">Đã thanh toán</span>
                                    @endif

                                </td>

                                @php
                                    $total_price = $value->book_total - $value->book_total/count($date) *($value->date_finish+$value->history_previous_date);
                                    $total_fund = $total_price*0.2;
                                @endphp
                                <td>{{ number_format($value->book_total - $value->book_total/count($date) *$value->history_previous_date ) }} <sup>đ</sup> </td>
                                <td>{{ number_format($total_fund) }} <sup>đ</sup> </td>
                                @if ($value->history_status == 3)
                                    <td><span class="badge border-danger border-1 text-danger">{{ number_format($total_fund) }} <sup>đ</sup> </span></td>
                                @else
                                <td><span class="badge border-success border-1 text-success">---</span></td>

                                @endif
                                @switch($value->history_status)
                                    @case(3)
                                        <td><span class="badge border-danger border-1 text-danger" style="color: white;width: 170px;">Đã hủy</span></td>
                                        <td><textarea name="" id="" cols="30" rows="3">{{ $value->book_notes }}</textarea></td>
                                        @break
                                    @default
                                        <td><span class="badge border-success border-1 text-success" style="color: white;width: 170px;">Hoàn thành</span></td>
                                        <td><textarea name="" id="" cols="30" rows="3">{{ $value->history_notes }}</textarea></td>
                                @endswitch


                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.hoadon-update',$value->history_id) }}"
                                            ><i class="bx bx-edit-alt me-1"></i> Duyệt</a>
                                        </div>
                                    </div>
                                </td>
                                <td><a href="{{ route('admin.details-book.show',$value->history_id) }}" class="btn btn-default btn-booking-details" id="{{ $value->history_id }}">Xem chi tiết</a>
                                <button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}"><i class="bi bi-eye"></i></button></td>


                            </tr>
                            @endforeach
                            {{-- @else
                                <tr><td>Bạn chưa có đơn đặt lịch nào!</td></tr>

                        @endif --}}
                        <p>Quy định
                            Hủy lịch khi đã thanh toán ca cố định
                             :Hoàn tiền những buổi chưa làm việc và trừ 20% tổng giá trị ban đầu.
                        </p>
                        <div id="modal-details"></div>
                    </tbody>
                </table>
            </div>

            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
