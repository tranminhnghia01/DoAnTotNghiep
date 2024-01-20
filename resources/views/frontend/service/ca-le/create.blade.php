@extends('frontend.service.form')
@section('form-service')
{{-- <form method="post" action="{{ route('home.giup-viec-ca-le.store') }}"> --}}
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

        <div class="col-md-6">
            <div class="form-floating">
                <label style="font-size: 18px; color: #000;font-weight: 700;margin-right: 20px" for="">Hoặc chọn trong lịch :</label>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <div class="col-md-12" id="sandbox-container">
                    <div class="input-group date form-control border-0" style="height: 51px;">
                        <input type="text" class="form-control border-0" name="book_date"><span class="input-group-addon"><i class="far fa-calendar" style="height: 100%;
                            font-size: 21px;
                            margin: auto;
                            padding: 8px;
                            padding-right: 8px;
                            color: orange;
                            background: #fff;"></i></span>
                    </div>
                    <script src="{{ asset('date/bootstrap-datepicker.min.js') }}"></script>

                    <script>
                    $('#sandbox-container .input-group.date').datepicker({
                        format: "dd/mm/yyyy",
                        todayBtn: "linked",
                        clearBtn: true,
                        multidate: false,
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
                    </div>
            </div>
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
            <label style="font-size: 18px; color: #000;font-weight: 700" for="email">Dịch vụ thêm</label>
            <div class="row">
                <div class="col-md-6">
                    <div class="options-check">
                        <label class='options-label'>
                            <input type='checkbox' class='options-input' name='options' value='Nấu ăn'>
                            <div class='options-text'><i class="fas fa-shopping-basket"></i> <br>Nấu ăn</div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class='options-label'>
                            <input type='checkbox' class='options-input ' name='options' value='Ủi đồ'>
                            <div class='options-text'><i class="fas fa-shopping-basket"></i> <br>Ủi đồ</div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class='options-label'>
                            <input type='checkbox' class='options-input' name='options' value='Đi chợ'>
                            <div class='options-text'><i class="fas fa-shopping-basket"></i> <br>Đi chợ</div>
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="">
                        <label class='options-label'>
                            <input type='checkbox' class='options-input' name='options' value='Mang dụng cụ'>
                            <div class='options-text'><i class="fas fa-shopping-basket"></i> <br>Mang dụng cụ<sup>(+30.000<sup>đ</sup>)</sup></div>
                            <textarea name="list_options" type="hidden" id="price_ot4" style="display: none" ></textarea>
                        </label>
                    </div>
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
            <button type="button" class="btn btn-orange w-100 py-3" id="check">Tiếp theo</button>
        </div>
    </div>
    <div id="modal-check">

    </div>
    {{-- @include('frontend.booking.modal2') --}}
</form>

<script>
    $(document).ready(function(){
        var today = new Date();
        var html ='';
        const weekday = ["CN","T2","T3","T4","T5","T6","T7"];

        for (let i = 0; i < 7; i++) {
            var nextDay = new Date();
            nextDay.setDate(today.getDate() + i);
            var m = nextDay;
            var getdate =("0" + (m.getUTCDate())).slice(-2) + "/" +
                ("0" + (m.getUTCMonth()+1)).slice(-2);


                var dateString =("0" + (m.getUTCDate())).slice(-2) + "/" +
                ("0" + (m.getUTCMonth()+1)).slice(-2) + "/" +
                ((m.getUTCFullYear()));

            let day = weekday[m.getDay()];
            let fullDay = day+','+ ("0"+ (m.getUTCDate())).slice(-2) + "/" +
                ("0" + (m.getUTCMonth()+1)).slice(-2) + "/" +
                ((m.getUTCFullYear()));
            // console.log(Full);
            html+="<label class='rad-label'>"+
                    "<input type='radio' class='rad-input' name='book_time_date' title="+fullDay+" value='"+dateString+"'>"+
                    "<div class='rad-text'>"+day+" <br>"+getdate+"</div>"+
                "</label>";
        };

        $('#dateweek').html(html);
    });
</script>
{{-- Bộ chọn giờ --}}
<script>
    function timePicker(id){
        var input = document.getElementById(id);
        var timePicker = document.createElement('div');
        timePicker.classList.add('time-picker');
        // input.value = '08:30';

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
        $(document).on('click', '.rad-input', function(e){
            var book_date = $('input[name="book_time_date"]:checked').val();
            $('input[name="book_date"]').val(book_date);
        });

        $(document).on('click','#submitTime',function(){
            var book_date = $('input[name="book_date"]').val();
            var book_time_start = $(".book_time_start").val();
            var now = date();
            if (book_date == now) {
                var split_time = book_time_start.split(':');
                const nowdate = new Date();
                const hour = nowdate.getHours();
                var hous_start = (split_time[0]) - 2;
                if (hous_start < hour) {
                    // alert('Thời gian hợp lệ')
                    swal({
                            icon: "error",
                            title: "Thời gian phải sau "+(hour+2)+':00 h...',
                            text: 'Vui lòng chọn lại thời gian bắt đầu làm việc',
                            });

                }
            }
            });


        $("#check").on('click',function(){
            var book_date = $('input[name="book_date"]').val();
            var service_id = $('input[name="service_id"]').val();
            var book_time_number = Number($('input[name="book_time_number"]:checked').val());
            var Klcv = $('input[name="book_time_number"]:checked').closest("label").find("div").text();

            var book_time_start = $(".book_time_start").val();
            var book_price = Number($('input[name="book_price"]').val());
            var book_notes = $('textarea[name="book_notes"]').val();

            // console.log(book_date);
            var book_options = [];
            $('input[name="options"]:checked').each(function() {
                book_options.push($(this).val());
                $('textarea[name="list_options"]').val(book_options);
            });


            var checkhours = true;
            var now = date();
            if (now == book_date) {
                var split_time = book_time_start.split(':');
                console.log(split_time);

                const nowdate = new Date();
                const hour = nowdate.getHours();
                console.log(hour);
                var hous_start = (split_time[0]) - 2;
                console.log(hous_start);
                if (hous_start >= hour) {
                    checkhours = true;
                }else{
                    checkhours = false;
                }
            }else{
                checkhours = true;
            }

            if (checkhours == true) {
                $.ajax({
                    url : "{{route('home.giup-viec.check-Booking')}}",
                    method: 'GET',
                    data:{book_date:book_date,
                        book_options:book_options,
                        book_price:book_price,
                        book_time_number:book_time_number,
                        book_time_start:book_time_start,
                        service_id:service_id,
                        Klcv:Klcv,book_notes:book_notes},
                    success:function(data){
                    $('#modal-check').html(data);
                    $('#exampleModal').modal('show');

                    }
                });

            }else{
                alert('Thời gian không hợp lệ, Vui lòng chọn lại');
            };

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
