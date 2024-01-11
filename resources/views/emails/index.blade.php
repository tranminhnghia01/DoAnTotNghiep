<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @php
    $listdate= explode(",",$book['book_date']);
        $split_time = explode(":",$book->book_time_start);
        if (count($split_time) == 1) {
            $time_end = (int) $split_time[0] + (int)$book->book_time_number .':'.'00';
        }else {
            $time_end = (int) $split_time[0] + (int)$book->book_time_number .':'.$split_time[1];

        }
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
                    <label for="" style="width: 50%;">Ngày làm việc</label>
                    <p class="check-date" style="width: 50%;text-align: right">{{ $listdate[0] }}</p>
                </div>
                <div style="display: flex; justify-content: space-between">
                    <label for=""style="width: 50%;">Làm trong</label>
                    <p class="check-time"style="width: 50%;text-align: right">{{ $book->book_time_number }} giờ, {{ $book->book_time_start }} đến {{$time_end}}</p>
                </div>

            <div style="display: flex; justify-content: space-between">
                <label for=""style="width: 50%;">Tổng số buổi</label>
                <p class="check-date"style="width: 50%;text-align: right">{{ count($listdate) }}</p>
            </div>

                <div style="display: flex; justify-content: space-between">
                    <label for=""style="width: 50%;">Ghi chú cho người làm</label>
                    <p class="check-notes"style="width: 50%;text-align: right">{{ $book->book_notes }}</p>
                </div>
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

</body>
</html>
