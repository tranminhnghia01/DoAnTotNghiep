

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('admin/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/echarts/echarts.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/quill/quill.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){


            var address = '';
            $('.choose').on('change',function(){
            $("#address").val("");

            var action = $(this).attr('id');
            var ma_id = $(this).val();
            // var ma_name = $(".choose option:selected").html();
            // alert(ma_name);
            var _token = $('input[name="_token"]').val();
            var result = '';

            if(action=='city'){
                result = 'province';
            }else{
                result = 'ward';
            }
            $.ajax({
                url : "{{route('admin.select-address')}}",
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);
                var ma_ct = $("#city option:selected").text();
                var pr = $("#province option:selected").text();


                address = ma_ct +", "+ pr
                console.log(address);
                }
            });

        });
        $('#ward').on('change',function(){
                var wa = $("#ward option:selected").text();
                $("#address").val(address+", "+wa);
            });



        const img = document.querySelector(".profile-image"),
        input =document.querySelector("#uploadImage");
        input.addEventListener("change",()=>{
          img.src = URL.createObjectURL(input.files[0]);
        });



      });

    </script>
    <script>
        $(document).ready(function(){
            $('.btn-chamcong').on('click',function(){
                        var book_id = $(this).data('book_id');
                        console.log(book_id);

            });

            //>>>>>>>> bắt đầu Ca lẻ



    //>>>>>>>> bắt đầu Ca cố định
    $('.btn-booking-details').on('click',function(){
        $('#modal-details').show();
         var action = $(this).data('action');
         console.log(action);

        var book_id = $(this).attr('id');
        // var _token = $('input[name="_token"]').val();
        $.ajax({
            url : "{{route('admin.details.show')}}",
            method: 'GET',
            data:{book_id:book_id,action:action},
            success:function(data){
                $('#modal-details').html(data);
                $('#exampleModal').modal('show');

            }
        });

    });
    $(document).on('click', '.btn-change-bookdefault', function(e){
        e.preventDefault(); //cancel default action
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
                    url : "{{route('home.appointment.destroydefault')}}",
                    method: 'POST',
                    data:{book_id:book_id,_token:_token},
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

    });
    // Kết thúc ca cố định<<<<<<<<<<

        })
    </script>

    </body>

</html>
