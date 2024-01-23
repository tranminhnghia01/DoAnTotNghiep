@extends('frontend.service.form')
@section('form-service')
{{-- <form method="post" action="{{ route('home.giup-viec-ca-co-dinh.store') }}"> --}}
    <form method="post" action="{{ route('home.giup-viec.store') }}">
    @csrf
    <div class="row g-3">
        <input type="hidden" name="book_price" value="{{ $service->service_price }}">
        <input type="hidden" name="service_id" value="{{ $service->service_id }}">
        <div class="col-md-12">
            <label style="font-size: 18px; color: #000;font-weight: 700" for="">Thời gian làm việc</label>
            <div id="dateweek"  style="display: flex;justify-content: space-around;" >
            </div>
            @error('book_date')
            <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12">
            <label style="font-size: 18px; color: #000;font-weight: 700" for="email">Thời lượng</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="">
                        <label class='time-total-label'>
                            <input type='radio' class='time-total-input' name='book_time_number' value='2'>
                            <div class='time-total-text'>2 Giờ <br>50 m<sup>2</sup></div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class='time-total-label'>
                            <input type='radio' class='time-total-input ' name='book_time_number' value='3'>
                            <div class='time-total-text'>3 Giờ <br>50-85 m<sup>2</sup></div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class='time-total-label'>
                            <input type='radio' class='time-total-input' name='book_time_number' value='4'>
                            <div class='time-total-text'>4 Giờ <br>85-110 m<sup>2</sup></div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class='time-total-label'>
                            <input type='radio' class='time-total-input' name='book_time_number' value='5'>
                            <div class='time-total-text'>5 Giờ <br>120 m<sup>2</sup></div>
                        </label>
                    </div>
                </div>
            </div>
            @error('book_time_number')
            <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12">
            <label style="font-size: 18px; color: #000;font-weight: 700" for="email">Thời gian bắt đầu</label>
            <div class="form-floating">
                <input type="text"
                    class="form-control border-0 col-sm-6 book_time_start"
                    placeholder="Choose time "id="timePicker" name="book_time_start"  style="height: 55px; padding: 0 12px" min="8:00">

            </div>
            @error('book_time_start')
            <span style="color: red">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12">
            <label style="font-size: 18px; color: #000;font-weight: 700" for="email">Loại gói</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="options-check">
                        <label class='options-label'>
                            <input type='radio' class='options-input' name='package_type' value='1'>
                            <div class='options-text'>1 tháng</div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class='options-label'>
                            <input type='radio' class='options-input ' name='package_type' value='2'>
                            <div class='options-text'>2 tháng</div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class='options-label'>
                            <input type='radio' class='options-input' name='package_type' value='3'>
                            <div class='options-text'>3 tháng</div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class='options-label'>
                            <input type='radio' class='options-input' name='package_type' value='6'>
                            <div class='options-text'>6 tháng</div>
                        </label>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-12" >
            <div class="row">
                <div class="form-floating form-control border-0 bg-white" style="display: flex; padding: 0">
                    <p style="font-size: 14px; color: #000" for="">Xem hoặc thay đổi lịch làm việc:</p>
                        <div class="input-group date " style="height: 51px;width: 100px; ">
                            <input type="text" class="form-control border-0" name="book_date" data-date-multidate-separator=";"><span class="input-group-addon"><i class="far fa-calendar" style="height: 100%;
                                font-size: 21px;
                                margin: auto;
                                padding: 8px;
                                padding-right: 8px;
                                color: orange;
                                background: #fff;"></i></span>
                        </div>

                    {{-- Bộ chọn ngày --}}
                        <script src="{{ asset('date/bootstrap-datepicker.min.js') }}"></script>
                        <script>
                            function getFullDays(month,book_dates) {
                                // console.log('listday'+book_dates);
                                var package_type = month;
                                var day = '';
                                for (let i = 0; i < package_type; i++) {
                                    var today = new Date();

                                    var nextmoth = today.getMonth() + i;
                                    // console.log('thang'+nextmoth);
                                    if (nextmoth > 11) {
                                        var daychange = new Date(today.getFullYear() + 1, nextmoth-12, 1);
                                    } else {
                                        var daychange = new Date(today.getFullYear(), nextmoth,today.getDate());
                                    }

                                    // console.log('ngay'+daychange);
                                    var d = new Date(daychange),
                                    month = d.getMonth(),
                                    mondays = [];
                                    // Get the first Monday in the month
                                    while (d.getDay() !== Number(book_dates)) {
                                        d.setDate(d.getDate() + 1);
                                    }
                                    // Get all the other Mondays in the month
                                    while (d.getMonth() === month) {
                                        mondays.push(new Date(d.getTime()));
                                        var dateString =("0" + (d.getUTCDate())).slice(-2) + "/" +
                                                        ("0" + (d.getUTCMonth()+1)).slice(-2) + "/" +
                                                        ((d.getUTCFullYear()));

                                        d.setDate(d.getDate() + 7);
                                        // console.log(dateString);
                                        day += dateString +',';
                                    }

                                }
                                    return day;
                                    console.log('Danh sách ngày được chọn'+day);


                            }

                            $('input[name="package_type"]').click(function(){
                                $('input[name="book_date"]').val('');

                              var  full = '';
                                var month = $(this).val();
                                var book_dates = [];
                                $('input[name="book_time_date"]:checked').each(function() {
                                    book_dates.push($(this).val());
                                    // $('textarea[name="list_options"]').val(book_options);
                                });

                                console.log('Gói'+month);
                                console.log('Ngày'+book_dates);
                                for (let i = 0; i < book_dates.length; i++) {
                                    console.log('numberday'+book_dates[i]);
                                    var daysMonths = getFullDays(month,book_dates[i]);
                                    full += daysMonths;
                                }

                                console.log(full.slice(0, -1));
                                $('input[name="book_date"]').val(full.slice(0, -1));
                            });

                            $('.input-group.date').datepicker({
                                format: "dd/mm/yyyy",
                                todayBtn: "linked",
                                clearBtn: true,
                                multidate: true,
                                todayHighlight: true,
                                startDate : date(),
                            });
                            function date() {
                                    var today = new Date();
                                    var dd = String(today.getDate()).padStart(2, '0');
                                    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                                    var yyyy = today.getFullYear();
                                    today = dd + '/' + mm + '/' + yyyy;
                                    return today;
                            }
                        </script>
                    {{-- end Bộ chọn ngày --}}

                </div>
            </div>
        </div>


        <div class="col-md-12">
            <label style="font-size: 18px; color: #000;font-weight: 700" for="email">Ghi chú cho người làm <br>
            <span style="font-weight: 300;color:#999">(Ghi chú này sẽ giúp CTV làm nhanh và tối hơn)</span></label>
            <div class="">
                <textarea class="form-control" rows="5" placeholder="Bạn có yêu cầu gì thêm, hãy nhập ở đây nhé" name="book_notes"></textarea>
            </div>
        </div>
        <div class="col-12 w-50 mx-auto">
            {{-- <button class="btn btn-orange w-100 py-3" type="submit">Book Đặt lịch</button> --}}
            <button type="button" class="btn btn-orange w-100 py-3" id="checkdefault">Tiếp theo</button>
        </div>
    </div>
    <div id="modal-check-default">

    </div>
</form>
<!-- Đặt lịch End -->
<script>
    $(document).ready(function(){
        $(document).on('click','#submitTime',function(){
            var book_date = $('input[name="book_date"]').val();
            console.log(book_date);
            var book_time_start = $(".book_time_start").val();
            var split_checkdate = book_date.split(',');

            var now = date();
            var check = split_checkdate.includes(now);
            console.log(check);
            if (check == true) {
                var split_time = book_time_start.split(':');
                const nowdate = new Date();
                const hour = nowdate.getHours();
                var hous_start = (split_time[0]) - 2;
                if (hous_start < hour) {
                    // alert('Thời gian hợp lệ')
                    swal({
                            icon: "error",
                            title: "Thời gian làm việc trong ngày "+now+'phải sau'+(hour +2)+':00h',
                            text: "Vui lòng điều chỉnh lại lịch làm việc!",
                            });

                }
            }
            });
        var today = new Date();
        var html ='';
        const weekday = ["T2","T3","T4","T5","T6","T7","CN"];

        for (let i = 0; i < 7; i++) {
            let day = weekday[i];
            let valday =i+2;
            if (valday>6) {
                valday = valday-7;
            }
            html+="<label class='service2-label'>"+
                    "<input type='checkbox' class='service2-input' name='book_time_date' value='"+valday+"'>"+
                    "<div class='service2-text' style='padding: 20px 12px;'>"+day+"</div>"+
                "</label>";
        };

        $('#dateweek').html(html);
    });
</script>
<script>
    function timePicker(id){
        var input = document.getElementById(id);
        var timePicker = document.createElement('div');
        timePicker.classList.add('time-picker');
        //open timepicker
        input.onclick= function(){
            timePicker.classList.toggle('open');

            this.setAttribute('disabled','disabled');
            timePicker.innerHTML +=`
                <div class="set-time">
                    <div class="label">
                        <a id="plusH" style="cursor: pointer;
                padding: 10px 20px; color:blue" ><span class="fa fa-arrow-up"></span></a>
                        <input class="set" type="text" id="hour" value="08" style="    text-align: center;
                border: none;
                width: 50px;">
                        <a id="minusH" style="cursor: pointer;
                padding: 10px 20px; color:blue"><span class="fa fa-arrow-down"></span></a>
                    </div>
                    <div class="label">
                        <a id="plusM" style="cursor: pointer;
                padding: 10px 20px; color:blue"><span class="fa fa-arrow-up"></span></a>
                        <input class="set" type="text" id="minute" value="30" style="    text-align: center;
                border: none;
                width: 50px;">
                        <a id="minusM" style="cursor: pointer;
                padding: 10px 20px; color:blue"><span class="fa fa-arrow-down"></span></a>
                    </div>
                </div>
                <div id="submitTime">Xác nhận</div>`;
            this.after(timePicker);
            var plusH = document.getElementById('plusH');
            var minusH = document.getElementById('minusH');
            var plusM = document.getElementById('plusM');
            var minusM = document.getElementById('minusM');
            var h = parseInt(document.getElementById('hour').value);
            var m = parseInt(document.getElementById('minute').value);
            //increment hour
            plusH.onclick = function(){
                h = isNaN(h) ? 0 : h;
                if(h===23){
                    h =-1;
                }
                h++;
                document.getElementById('hour').value = (h<10?'0':0)+h;
            }
            //decrement hour
            minusH.onclick = function(){
                h = isNaN(h) ? 0 : h;
                if(h===0){
                    h =24;
                }
                h--;
                document.getElementById('hour').value = (h<10?'0':0)+h;
            }
            //increment hour
            plusM.onclick = function(){
                m = isNaN(m) ? 0 : m;
                if(m===30){
                    m =-30;
                }
                m = m+30;
                document.getElementById('minute').value = (m<10?'0':0)+m;
            }
            //decrement hour
            minusM.onclick = function(){
                m = isNaN(m) ? 0 : m;
                if(m===0){
                    m =60;
                }
                m = m-30;
                document.getElementById('minute').value = (m<10?'0':0)+m;
            }

            //submit timepicker
            var submit = document.getElementById("submitTime");
            submit.onclick = function(){
                input.value = document.getElementById('hour').value+':'+document.getElementById('minute').value;
                input.removeAttribute('disabled');
                timePicker.classList.toggle('open');
                timePicker.innerHTML = '';
            }
        }
    }
    timePicker('timePicker');
</script>
<script>
    $(document).ready(function(){

        $("#checkdefault").on('click',function(){
            // var book_date = $('input[name="book_time_date"]:checked').val();
            var book_date = $('input[name="book_date"]').val();
            var service_id = $('input[name="service_id"]').val();
            var book_time_number = Number($('input[name="book_time_number"]:checked').val());
            var Klcv = $('input[name="book_time_number"]:checked').closest("label").find("div").text();

            var book_time_start = $(".book_time_start").val();
            var book_price = Number($('input[name="book_price"]').val());
            var book_notes = $('textarea[name="book_notes"]').val();

            var package_type = Number($('input[name="package_type"]:checked').val());
            var split_checkdate = book_date.split(',');

            var now = date();
            var check = split_checkdate.includes(now);
            console.log(check);
            if (check == true) {
                var split_time = book_time_start.split(':');
                const nowdate = new Date();
                const hour = nowdate.getHours();
                var hous_start = (split_time[0]) - 2;
                if (hous_start < hour) {
                    // alert('Thời gian hợp lệ')
                    swal({
                        icon: "error",
                        title: "Thời gian làm việc trong ngày "+now+'phải sau'+(hour +2)+':00h' ,
                        text: "Vui lòng điều chỉnh lại lịch làm việc!",
                        });

                }else{
                    $.ajax({
                        url : "{{route('home.giup-viec.check-Booking')}}",
                        method: 'GET',
                        data:{book_date:book_date,
                            book_price:book_price,
                            book_time_number:book_time_number,
                            book_time_start:book_time_start,
                            service_id:service_id,
                            Klcv:Klcv,book_notes:book_notes,
                            package_type:package_type},
                        success:function(data){
                            $('#modal-check-default').html(data);
                            $('#exampleModal').modal('show');
                        }
                    });
                }
            }
            if (check == false) {
                $.ajax({
                url : "{{route('home.giup-viec.check-Booking')}}",
                method: 'GET',
                data:{book_date:book_date,
                    book_price:book_price,
                    book_time_number:book_time_number,
                    book_time_start:book_time_start,
                    service_id:service_id,
                    Klcv:Klcv,book_notes:book_notes,
                    package_type:package_type},
                success:function(data){
                   $('#modal-check-default').html(data);
                   $('#exampleModal').modal('show');

                }
            });
            }

            $(document).on('change', '#coupon', function(e){
                var coupon = $(this).val();
                var book_total =  $('input[name="book_total"]').val();
                var split_coupon= coupon.split(',');
                var coupon_id = split_coupon[0];
                var coupon_method = split_coupon[1];
                var coupon_number = split_coupon[2];
                console.log(split_coupon);
                if (coupon_method == 0) {
                    total_coupon = (book_total)*coupon_number/100;
                    console.log(total_coupon);
                }else{
                    console.log(coupon_number);
                    total_coupon =coupon_number;
                }
                var total = book_total - total_coupon;
                totalfm = total.toLocaleString('vi', {style : 'currency', currency : 'VND'});
                $('.book-total').text(totalfm);
            });
        });
    })
</script>
@endsection
