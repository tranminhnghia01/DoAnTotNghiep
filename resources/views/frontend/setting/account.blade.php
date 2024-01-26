
@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Cài đặt</p>
            <h1>Hồ sơ cá nhân</h1>
        </div>
        <div class="row">
            <div class="col-xl-4">

              <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    @if ($shipping->shipping_image)
                        <img src="{{ asset('uploads/users/'.$shipping->shipping_image) }}" alt="Profile" class="rounded-circle" style="width: 150px;height: 150px;">
                    @else
                        <img src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="Profile" class="rounded-circle">
                    @endif
                  {{-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> --}}
                  <h2>{{ $shipping->shipping_name }}</h2>
                  <h3>Khách hàng</h3>
                  <div class="social-links mt-2">
                    <a  class="twitter"><i class="bi bi-twitter"></i></a>
                    <a  class="facebook"><i class="bi bi-facebook"></i></a>
                    <a  class="instagram"><i class="bi bi-instagram"></i></a>
                    <a  class="linkedin"><i class="bi bi-linkedin"></i></a>
                  </div>
                </div>
              </div>

            </div>

            <div class="col-xl-8">

              <div class="card">
                <div class="card-body pt-3">
                  <!-- Bordered Tabs -->
                  <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">Giới thiệu</button>
                    </li>

                    <li class="nav-item" role="presentation">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" role="tab" tabindex="-1">Cập nhật hồ sơ</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password" aria-selected="false" role="tab" tabindex="-1">Thay đổi mật khẩu</button>
                    </li>

                  </ul>
                  <div class="tab-content pt-2">

                    <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel">
                      <h5 class="card-title">Giới thiệu</h5>
                      <p class="small fst-italic">Họ đã bị giải thể vào thời của những người tố cáo, cũng như ở thời xa xưa. Không có thời gian tự do để từ đó đến, đó là đau khổ. Vì chúng nằm trong quy luật của vạn vật, nhưng bất kỳ ai cũng ghét phải chứng kiến ​​chúng xảy ra. Để theo dõi chuyến bay, nhưng nó thường đến từ hư không.</p>

                      <h5 class="card-title">Chi tiết hồ sơ</h5>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label ">Họ và tên</div>
                        <div class="col-lg-9 col-md-8">{{ $shipping->shipping_name }}</div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Quốc gia</div>
                        <div class="col-lg-9 col-md-8">Việt Nam</div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Công việc</div>
                        <div class="col-lg-9 col-md-8">Người dùng</div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Thành phố</div>
                        <div class="col-lg-9 col-md-8">Đà Nẵng</div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Địa chỉ</div>
                        <div class="col-lg-9 col-md-8">{{ $shipping->shipping_address }}</div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Số điện thoại</div>
                        <div class="col-lg-9 col-md-8">(48) {{ $shipping->shipping_phone }}</div>
                      </div>

                      <div class="row">
                        <div class="col-lg-3 col-md-4 label">Email</div>
                        <div class="col-lg-9 col-md-8">{{ $shipping->shipping_email }}</div>
                      </div>

                    </div>

                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit" role="tabpanel">

                      <!-- Profile Edit Form -->
                      <!-- Profile Edit Form -->
                    @include('frontend.setting.profile')

                        <!-- End Profile Edit Form -->


                    </div>
                    <div class="tab-pane fade pt-3" id="profile-change-password" role="tabpanel">
                      <!-- Change Password Form -->
                      <form action="{{ route('home.update-password') }}" method="POST">
                        @csrf
                        <div class="row mb-3">
                          <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mật khẩu cũ</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="old_password" type="password" class="form-control" id="currentPassword">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Mật khẩu mới</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPassword">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Nhập lại mật khẩu mới</label>
                          <div class="col-md-8 col-lg-9">
                            <input name="new_password_confirmation" type="password" class="form-control" id="renewPassword">
                          </div>
                        </div>

                        <div class="text-center">
                          <button type="submit" class="btn btn-primary">Thay đổi mật khẩu</button>
                        </div>
                      </form>


                    </div>

                  </div><!-- End Bordered Tabs -->

                </div>
              </div>

            </div>
          </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        //>>>>>>>> bắt đầu Ca lẻ
        $('.btn-details').on('click',function(){
            $('#modal-details').show();
            $("#address").val();

            var book_id = $(this).attr('id');
            // var _token = $('input[name="_token"]').val();
            $.ajax({
                url : "{{route('home.appointment.show')}}",
                method: 'GET',
                data:{book_id:book_id},
                success:function(data){
                    $('#modal-details').html(data);
                    $('#exampleModal').modal('show');

                }
            });

        });
        $(document).on('click', '.btn-change-book', function(e){
            e.preventDefault(); //cancel default action
            var history_notes = $('textarea[name="history_notes"]').val();
            if (history_notes == "") {
                swal({
                        title: "Lỗi!",
                        text: "Vui lòng nếu lý do trước để tiếp tục hủy!",
                        icon: "warning",
                        dangerMode: true,
                        });
            }else{
                swal({
                title: "Hủy ??",
                text: 'Bạn có chắc muốn hủy đơn đặt lịch này!',
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        var book_id = $(this).data('book-id');
                        var _token = $('input[name="_token"]').val();
                        $.ajax({
                            url : "{{route('home.appointment.destroy')}}",
                            method: 'POST',
                            data:{history_notes:history_notes,book_id:book_id,_token:_token},
                            success:function(data){
                                swal("Thành công! Đơn đặt lịch của bạn đã được hủy!", {
                                    icon: "success",
                                    });
                                    window.setTimeout(function() {
                                        location.reload();
                                    },3000);
                                }
                            });
                    } else {
                        swal("Thoát thao tác thành công!");
                    }
                });
            };



        });
        // Kết thúc ca lẻ>>>>>>>>>>>


        // //>>>>>>>> bắt đầu Ca cố định
        // $('.btn-details-fixed').on('click',function(){
        //     $('#modal-details').show();
        //     $("#address").val();

        //     var book_id = $(this).attr('id');
        //     // var _token = $('input[name="_token"]').val();
        //     $.ajax({
        //         url : "",
        //         method: 'GET',
        //         data:{book_id:book_id},
        //         success:function(data){
        //             $('#modal-details').html(data);
        //             $('#exampleModal').modal('show');

        //         }
        //     });

        // });
        // $(document).on('click', '.btn-change-bookdefault', function(e){
        //     e.preventDefault(); //cancel default action
        //      var history_notes = $('textarea[name="history_notes"]').val();
        //     if (history_notes  == "") {
        //         swal({
        //                 title: "Lỗi!",
        //                 text: "Vui lòng nếu lý do trước để tiếp tục hủy!",
        //                 icon: "warning",
        //                 dangerMode: true,
        //                 });
        //     }else{
        //         swal({
        //         title: "Hủy ??",
        //         text: 'Bạn có chắc muốn hủy đơn đặt lịch này!',
        //         icon: "warning",
        //         buttons: true,
        //         dangerMode: true,
        //     })
        //     .then((willDelete) => {
        //         if (willDelete) {
        //             var book_id = $(this).data('book-id');
        //             var _token = $('input[name="_token"]').val();
        //             $.ajax({
        //                 url : "",
        //                 method: 'POST',
        //                 data:{book_id:book_id,_token:_token,history_notes:history_notes},
        //                 success:function(data){
        //                     console.log(data);
        //                     swal("Thành công! Đơn đặt lịch của bạn đã được hủy!", {
        //                         icon: "success",
        //                         });
        //                         window.setTimeout(function() {
        //                             location.reload();
        //                         },3000);
        //                     }
        //                 });
        //         } else {
        //             swal("Thoát thao tác thành công!");
        //         }
        //     });
        //     };


        // });
        // // Kết thúc ca cố định<<<<<<<<<<



        //Dánh giá modal
        $('.danhgia').on('click',function(){
            // $('#modal-details').show();
            // alert('234');
            var book_id = $(this).data('book_id');
            // alert(book_id);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url : "{{route('home.appointment.danhgia')}}",
                method: 'GET',
                data:{book_id:book_id},
                success:function(data){
                    $('#modal-danhgia').html(data);
                    $('#Modaldanhgia').modal('show');

                }
            });



        });




    });
    </script>
  @endsection
