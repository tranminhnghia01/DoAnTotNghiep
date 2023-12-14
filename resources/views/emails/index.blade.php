@php

    $listdate= explode(",",$book['book_date']);

         $count_date= count($listdate);
        if($book->service_id == 2){
            for ($i=0; $i < $count_date; $i++) {
                $changedate = explode("/", $listdate[$i]);
                 $listdate[$i] = $changedate[1].'/'.$changedate[0].'/'.$changedate[2];
            }
        }
        $split_time = explode(":",$book->book_time_start);
        $time_end = $split_time[0]+$book->book_time_number .':'.$split_time[1];
@endphp

<div style="width: 600px;text-align: center;font-size: 16px">
    <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">Xác nhận và thanh toán</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body" style="color: #000;text-align: left">

        <div class="row g-3">
            <h2 class="modal-title">Vị trí làm việc</h2>
            <div class="col-sm-12" style="  border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                <p style="font-weight: 600">{{ $book->shipping_name }}</p>
                <p> Số điện thoại: (+84)  {{ $book->shipping_phone }}</p>
                <p>Địa chỉ {{ $book->shipping_address }}</p>
            </div>
            <h2 class="modal-title">Thông tin công việc</h2>
            <div class="col-sm-12" style="border: 1px solid #ccc; border-radius: 5px; padding: 20px;">
                <h3 style="font-weight: 600">Thời gian làm việc</h3>
                <div style="display: flex; justify-content: space-between">
                    <label for="" style="width: 50%;">Ngày bắt đầu làm việc</label>
                    <p class="check-date" style="width: 50%;text-align: right">{{ date('d/m/Y',strtotime($listdate[0])) }}</p>
                </div>
                @if ($book->service_id == 2)
                    <div style="display: flex; justify-content: space-between">
                        <label for=""style="width: 50%;">Ngày kết thúc làm việc</label>
                        <p class="check-date" style="width: 50%;text-align: right">{{ date('d/m/Y',strtotime($listdate[$count_date-1])) }}</p>
                    </div>
                @endif
                <div style="display: flex; justify-content: space-between">
                    <label for=""style="width: 50%;">Làm trong</label>
                    <p class="check-time"style="width: 50%;text-align: right">{{ $book->book_time_number }} giờ, {{ $book->book_time_start }} đến {{$time_end}}</p>
                </div>

            <div style="display: flex; justify-content: space-between">
                <label for=""style="width: 50%;">Tổng số buổi</label>
                <p class="check-date"style="width: 50%;text-align: right">{{ $count_date }}</p>
            </div>

                <div style="display: flex; justify-content: space-between">
                    <label for=""style="width: 50%;">Ghi chú cho người làm</label>
                    <p class="check-notes"style="width: 50%;text-align: right">{{ $book->book_notes }}</p>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <h5 class="modal-title"style="width: 50%;">Phương thức thanh toán: </h5>
                    <h5 class="modal-title"style="width: 50%;text-align: right">{{ $book->payment_method }}</h5>
                </div>
                @if ($book->coupon_id != 0)
                    <div style="display: flex; justify-content: space-between">
                        <h5 class="modal-title"style="width: 50%;">Khuyến mãi: </h5>
                        <h5 class="modal-title"style="width: 50%;text-align: right">{{ $book->coupon_number }}
                            @if ($book->coupon_method == 0)
                                %
                            @else
                                đ
                            @endif
                        </h5>
                    </div>
                @endif

            </div>


        </div>
    </div>
    <div style="display: flex;
    justify-content: space-between;
    background-color: orange;
    font-size: 18px;
    padding: 0px 20px;">
        <h2 class="modal-title" style="width:50%; text-align: left;">Tổng Cộng</h2>
            <h2 class="modal-title book-total" style="width:50%;text-align: right">{{ number_format($book->book_total) }} <sup>đ</sup></h2>
    </div>
</div>
