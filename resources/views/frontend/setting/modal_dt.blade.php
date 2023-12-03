
<div class="modal fade show" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-modal="true" style="display: block;padding-left: 0px">
    <div class="modal-dialog">
        <div class="bg-white modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xác nhận và thanh toán</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="color: #000;">

                <div class="row g-3">
                    <h5 class="modal-title">Vị trí làm việc</h5>
                    <div class="col-sm-12" style="    border: 1px solid #ccc;border-radius: 5px;padding: 20px;">
                        <p style="font-weight: 600">{{ $shipping->shipping_name }}</p>
                        <p> Số điện thoại: (+84)  {{ $shipping->shipping_phone }}</p>
                        <p>{{ $shipping->shipping_address }} <br> <a href="{{ route('home.checkout') }}" class="btn btn-success" style="float: right">Thay đổi</a></p>


                    </div>
                    <h5 class="modal-title">Thông tin công việc</h5>
                    <div class="col-sm-12" style="    border: 1px solid #ccc; border-radius: 5px; padding: 20px;">
                        <p style="font-weight: 600">Thời gian làm việc</p>
                        <div style="display: flex; justify-content: space-between">
                            <label for="">Ngày làm việc</label>
                            <p class="check-date">T3,29/11/2023 - 14:00</p>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <label for="">Làm trong</label>
                            <p class="check-time">4 giờ, 14:00 đến 18:00</p>
                        </div>

                        <p style="font-weight: 600">Chi tiết công việc</p>
                        <div style="display: flex; justify-content: space-between">
                            <label for="">Khối lượng công việc</label>
                            <p class="check-g">105m<sup>2</sup></p>
                        </div>
                        <div style="display: flex; justify-content: space-between">
                            <label for="">Dịch vụ thêm</label>
                            <p id="options" class="check-options">Nấu ăn, Mang theo dụng cụ</p>
                        </div>

                        <div style="display: flex; justify-content: space-between">
                            <label for="">Ghi chú cho người làm</label>
                            <p class="check-notes"></p>
                        </div>
                    </div>
                    <h5 class="modal-title">Phương thức thanh toán| Khuyễn mãi</h5>
                    <div class="col-12 col-sm-6">
                        <select class="form-select border-0" style="height: 55px;" name="payment_id">
                            {{-- @foreach ($payment as $key=>$valP )
                                <option value="{{ $valP->payment_id }}">{{ $valP->payment_method }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="col-12 col-sm-6">
                        <select class="form-select border-0" id="coupon" style="height: 55px;" name="coupon_id">
                            <option selected  value="0,0,0">Khuyễn mãi</option>
                            {{-- @foreach ($coupon as $key=>$valC )
                                @php
                                    $time_start = date('d/m/Y',strtotime($valC->coupon_time_start));
                                    $time_end = date('d/m/Y',strtotime($valC->coupon_time_end));
                                    $today = date('d/m/Y',strtotime(now()));
                                @endphp
                                <option value="{{ $valC->coupon_id }},{{ $valC->coupon_method }},{{ $valC->coupon_number }}" @if ($time_end >= $today)
                                    disabled style="color: red"
                                    @else
                                @endif>{{ $valC->coupon_name }}</option>

                            @endforeach --}}
                        </select>
                    </div>
                </div>
            </div>
            <div style="display: flex; justify-content: space-between">
                <h4 class="modal-title">Tổng Cộng</h4>
            <h4 class="modal-title book-total">123123</h4>
            <input type="hidden" name="book_total" value="">
            </div>

            <div class="modal-footer">
            <button type="submit" class="btn btn-orange w-100 py-3">Đặt lịch</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        var total ='';
        var total_coupon ='';

        $("#check").on('click',function(){
        var book_time_start = $(".book_time_start").val();
        var book_time_number = Number($('input[name="book_time_number"]:checked').val());
        var book_date = $('input[name="book_date"]:checked').val();
        var fullDay = $('input[name="book_date"]:checked').attr('title');

        console.log(book_time_number);
        console.log(book_date);

        if (isNaN(book_time_number) || book_date == undefined  ) {
            alert('Vui long nhập đầy đủ thông tin!');
        }else{
        var split_start_time= book_time_start.split(':');
        var start_end = parseInt(split_start_time[0])+parseInt(book_time_number) +':'+split_start_time[1];

        var klvc = $('input[name="book_time_number"]:checked').closest("label").find("div").text();
        var book_notes = $('textarea[name="book_notes"]').val();

        var add_price = Number($('textarea[id="price_ot4"]').val());
            // options
        var book_price = Number($('input[name="book_price"]').val());

        $('.check-date').text(fullDay+' - '+book_time_start);
        $('.check-time').text(book_time_number+" giờ, "+book_time_start+" đến "+start_end);
        $('.check-g').html(klvc);
        $('.check-notes').text(book_notes);
        //Chẹck thứ
        var checkdayofweek= fullDay.split(',');
        var day = checkdayofweek[0];
        if (day == 'T7' ||  day=="CN") {
            book_price = book_price+10000;
        }

        ///Tính tổng tiền
        var total = book_time_number * book_price +add_price - total_coupon;
        totalfm = total.toLocaleString('vi', {style : 'currency', currency : 'VND'})
        $('.book-total').text(totalfm);
        $('input[name="book_total"]').val(total);

        $('#coupon').on('change',function(){
            var coupon = $(this).val();
            var split_coupon= coupon.split(',');
            var coupon_id = split_coupon[0];
            var coupon_method = split_coupon[1];
            var coupon_number = split_coupon[2];
            console.log(split_coupon);
            if (coupon_method == 0) {
                total_coupon = (book_time_number * book_price +add_price)*coupon_number/100;
                console.log(total_coupon);
            }else{
                console.log(coupon_number);
                total_coupon =coupon_number;
            }
            var total = book_time_number * book_price +add_price - total_coupon;
            totalfm = total.toLocaleString('vi', {style : 'currency', currency : 'VND'});
            $('.book-total').text(totalfm);
            $('input[name="book_total"]').val(total);
        });

        }




    });

    })
</script>
