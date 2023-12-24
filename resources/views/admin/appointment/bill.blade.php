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
                            <th>Người giúp việc</th>
                            <th>Số buổi đã hoàn thành</th>
                            <th>HTTT</th>
                            <th>Hóa đơn gốc</th>
                            <th>Thanh toán</th>
                            <th>Xem nhanh</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if (!empty($book)) --}}
                            @foreach ($book as $key=>$value )
                            <tr>
                                <td>{{ $key+1}}</td>
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
                                    $total_price = $value->book_total/count($date) *$value->date_finish;
                                @endphp
                                <td>{{ number_format($value->book_total - $value->book_total/count($date) *$value->history_previous_date ) }} <sup>đ</sup> </td>
                                <td>{{ number_format($total_price) }} <sup>đ</sup> </td>
                                @switch($value->history_status)
                                    @case(3)
                                        <td><span class="btn btn-danger" style="color: white;width: 170px;">Đã hủy</span></td>
                                        @break
                                    @default
                                        <td><span class="btn btn-primary" style="color: white;width: 170px;">Hoàn thành</span></td>
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
                                <td><button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}">Xem chi tiết</button></td>


                            </tr>
                            @endforeach
                            {{-- @else
                                <tr><td>Bạn chưa có đơn đặt lịch nào!</td></tr>

                        @endif --}}
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