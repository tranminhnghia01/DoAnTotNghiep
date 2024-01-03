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
                            <th>Người hẹn</th>
                            <th>Dịch vụ</th>
                            <th>Ngày bắt đầu làm việc</th>
                            <th>Xem chi tiết</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @if (!empty($book)) --}}
                            @foreach ($book as $key=>$value )
                            <tr>
                                <td>{{ $key+1}}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->shipping_name }}</td>
                                <td>{{ $value->service_name }}</td>
                                @switch($value->history_status)
                                    @case(3)
                                        <td><span class="btn btn-danger" style="color: white;width: 170px;">Đã hủy</span></td>
                                        @break
                                    @default
                                        <td><span class="btn btn-primary" style="color: white;width: 170px;">Hoàn thành</span></td>
                                @endswitch
                                <td><a href="{{ route('admin.details-book.show',$value->history_id) }}" class="btn btn-default btn-booking-details" id="{{ $value->history_id }}">Xem chi tiết</a>
                                    <button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}"><i class="bi bi-eye"></i></button></td>


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
