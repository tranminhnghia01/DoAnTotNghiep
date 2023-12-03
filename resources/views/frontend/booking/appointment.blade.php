@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <p class="d-inline-block border rounded-pill py-1 px-4">Đặt lịch</p>
                <h1 class="mb-4">Giúp việc nhà theo giờ</h1>
                <p class="mb-4">Nhịp sống đô thị đang dần trở nên bận rộn hơn với công việc và xã hội. Đặc biệt thời gian của người phụ nữ dành cho gia đình và chăm sóc nhà cửa cũng càng trở nên eo hẹp hơn. Vậy làm sao để cân bằng được giữa công việc và gia đình luôn là vấn đề khúc mắc của nhiều gia đình Việt. Đã có nhiều gia đình bỏ ra một khoản tiền lớn hằng tháng chỉ để thuê giúp việc cố định nhưng đôi lúc việc này trở nên không thực sự cần thiết vì không phải lúc nào cũng có việc để người giúp việc làm liên tục. Lúc này giúp việc nhà theo giờ sẽ là giải pháp hợp lý cho mọi gia đình!</p>
                <div class="bg-light rounded d-flex align-items-center p-5 mb-4">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                        <i class="fa fa-phone-alt text-orange"></i>
                    </div>
                    <div class="ms-4">
                        <p class="mb-2">Số điện thoại</p>
                        <h5 class="mb-0">{{ $shipping->shipping_phone }}</h5>
                    </div>
                </div>
                <div class="bg-light rounded d-flex align-items-center p-5">
                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center rounded-circle bg-white" style="width: 55px; height: 55px;">
                        <i class="fa fa-envelope-open text-orange"></i>
                    </div>
                    <div class="ms-4">
                        <p class="mb-2">Địa chỉ của tôi</p>
                        <h5 class="mb-0">{{ $shipping->shipping_address }}  <span><a href="{{ route('home.checkout') }}" title="Thay đổi"><i class="fas fa-map-marked-alt"></i></a></span></h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s" style="color: #000">
                <div class="bg-light rounded h-100 d-flex align-items-center p-5">
                    <form method="post" action="{{ route('home.giup-viec-ca-le.store') }}">
                        @csrf
                        <div class="row g-3">
                            <input type="hidden" name="book_price" value="80000">
                            <input type="hidden" name="service_id" value="1">
                            <div class="col-md-12">
                                <label style="font-size: 18px; color: #000;font-weight: 700" for="">Dịch vụ</label>
                                <select class="form-select border-0" style="height: 55px;">
                                    <option selected value="1">Giúp việc ca lẻ</option>
                                    <option value="2">Giúp việc ca cố định</option>
                                </select>

                            </div>

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
                                                <input type='checkbox' class='options-input' name='options[]' value='Nấu ăn'>
                                                <div class='options-text'><i class="fas fa-shopping-basket"></i> <br>Nấu ăn</div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <label class='options-label'>
                                                <input type='checkbox' class='options-input ' name='options[]' value='Ủi đồ'>
                                                <div class='options-text'><i class="fas fa-shopping-basket"></i> <br>Ủi đồ</div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <label class='options-label'>
                                                <input type='checkbox' class='options-input' name='options[]' value='Đi chợ'>
                                                <div class='options-text'><i class="fas fa-shopping-basket"></i> <br>Đi chợ</div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="">
                                            <label class='options-label'>
                                                <input type='checkbox' class='options-input' name='options[]' value='Mang dụng cụ'>
                                                <div class='options-text'><i class="fas fa-shopping-basket"></i> <br>Mang dụng cụ<sup>(+30.000<sup>đ</sup>)</sup></div>
                                                <textarea name="price_os4" type="hidden" id="price_ot4" style="display: none" >0</textarea>
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
                                {{-- <button class="btn btn-orange w-100 py-3" type="submit">Book Đặt lịch</button> --}}
                                <button type="button" class="btn btn-orange w-100 py-3" id="check">Tiếp theo</button>
                                {{-- <button type="button" class="btn btn-orange w-100 py-3 btn-check-book">Tiếp theo</button> --}}
                            </div>
                        </div>
                        <div id="modal-check"></div>
                        @include('frontend.booking.modal')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Đặt lịch End -->
@php
    $today = date('d/m/Y',strtotime(now()));

@endphp


<script>
    $(document).ready(function(){
        // $('.datetimepicker-input').datetimepicker();
        var today = new Date();
        var html ='';
        const weekday = ["CN","T2","T3","T4","T5","T6","T7"];

        for (let i = 0; i < 7; i++) {
            var nextDay = new Date();
            nextDay.setDate(today.getDate() + i);
            var m = nextDay;
            var getdate =("0" + (m.getUTCDate())).slice(-2) + "/" +
                ("0" + (m.getUTCMonth()+1)).slice(-2);


                var dateString =("0" + (m.getUTCDate())).slice(-2) + "-" +
                ("0" + (m.getUTCMonth()+1)).slice(-2) + "-" +
                ((m.getUTCFullYear()));

            let day = weekday[m.getDay()];
            let fullDay = day+','+ ("0"+ (m.getUTCDate())).slice(-2) + "/" +
                ("0" + (m.getUTCMonth()+1)).slice(-2) + "/" +
                ((m.getUTCFullYear()));
            // console.log(Full);
            html+="<label class='rad-label'>"+
                    "<input type='radio' class='rad-input' name='book_date' title="+fullDay+" value='"+dateString+"'>"+
                    "<div class='rad-text'>"+day+" <br>"+getdate+"</div>"+
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
   input.value = '08:30';

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
    var listOS = document.getElementById('options');
    var text ='';
    var price_os4 = document.getElementById('price_ot4');


    var ListArr = [];
    var checkboxs = document.querySelectorAll('.options-input');
    for (var checkbox of checkboxs) {
        checkbox.addEventListener('click',function(){
            if (this.checked == true) {

                ListArr.push(this.value);
                listOS.innerHTML =text+ListArr.join(' , ');
                if (this.value == "Mang dụng cụ") {
                    price_os4.innerHTML = 30000;
                }

            }else{
                ListArr = ListArr.filter(e=> e!== this.value);
                if (this.value == "Mang dụng cụ") {
                    price_os4.innerHTML = 0;
                }
                listOS.innerHTML =text+ListArr.join(' , ');

            }
        })

    }
</script>
@endsection
