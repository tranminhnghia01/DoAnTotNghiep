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
                            <th>Đã hoàn thành(Buổi)</th>
                            <th>Thanh toán(Lý do)</th>
                            <th>Trạng thái</th>
                            <th>Trạng thái</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if (!empty($book)) --}}
                            @foreach ($book as $key=>$value )
                            @php
                                    $date =  explode(",",$value->book_date);
                            @endphp
                            <tr>
                                <td>{{ $key+1}}</td>
                                <td>{{ $value->book_id}}</td>
                                <td>{{ $value->date_finish }}/{{ count($date)-$value->history_previous_date }}</td>
                                <td>
                                    @if ($value->payment_id == 1)
                                        @if ($value->service_id == 2)
                                            <span class="badge border-danger border-1 text-danger">Khách hàng chưa thanh toán</span>
                                        @else
                                            <span class="badge border-success border-1 text-success">Tiền mặt</span>

                                        @endif
                                    @else
                                        <span class="badge border-success border-1 text-success">Đã thanh toán Online</span>
                                    @endif
                                </td>

                                @switch($value->book_status)
                                    @case(3)
                                        <td><span class="badge border-danger border-1 text-danger" style="color: white;width: 170px;">Khách hàng đã hủy lịch</span></td>
                                        @break
                                    @default
                                        <td><span class="badge border-success border-1 text-success" style="color: white;width: 170px;">Hoàn thành</span></td>
                                @endswitch
                                @if ($value->processing == 1)
                                    <td>
                                        <span class="btn btn-danger">chưa duyệt</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="btn btn-primary">Đã duyệt</span>
                                    </td>
                                @endif
                                <td><a href="{{ route('admin.details-book.show',$value->history_id) }}" class="btn btn-default btn-booking-details" id="{{ $value->history_id }}">Xem chi tiết</a></td>
                                <td><button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}"><i class="bi bi-eye"></i></button></td>
                            </tr>
                            @endforeach
                        <div id="modal-details"></div>
                    </tbody>
                </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

@endsection



