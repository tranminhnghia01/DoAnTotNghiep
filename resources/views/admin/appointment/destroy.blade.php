
<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
    <div class="table-responsive">
        <table class="table datatable" style="text-align: center">
            <thead>
                <tr>
                    <th>Mã hóa đơn</th>
                    <th>Mã đơn lịch</th>
                    <th>Tổng hóa đơn</th>
                    <th>Lý do</th>
                    <th>Tình trạng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                {{-- @if (!empty($book)) --}}
                    @foreach ($bill as $key =>$value )
                    @if ($value->book_status == 3)
                    <tr>
                        <td>{{ $value->history_id }}</td>
                        <td>{{ $value->book_id }}</td>
                        <td>{{ number_format($value->book_total) }} <sup>đ</sup> </td>
                        <td><span  style="float: left">{{ $value->book_notes }}</span></td>
                        <td><span class="btn btn-danger" style="color: white;width: 170px;">Đã hủy</span></td>
                        <td><button type="button" class="btn btn-default btn-booking-details" id="{{ $value->book_id }}"><i class="bi bi-eye"></i></button></td>
                    </tr>
                @endif
                    @endforeach

            </tbody>
        </table>
    </div>
</div>
