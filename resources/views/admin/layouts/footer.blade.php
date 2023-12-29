

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

    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>


<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('admin/ckfinder/ckfinder.js') }}"></script>

<script>
    CKEDITOR.replace('content', {
        filebrowserBrowseUrl: "{{ asset('admin/ckfinder/ckfinder.html') }}",
        filebrowserUploadUrl: "{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
      } );
      CKEDITOR.replace('coupon_content', {
        filebrowserBrowseUrl: "{{ asset('admin/ckfinder/ckfinder.html') }}",
        filebrowserUploadUrl: "{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
      });
      CKEDITOR.replace('blog_content', {
        filebrowserBrowseUrl: "{{ asset('admin/ckfinder/ckfinder.html') }}",
        filebrowserUploadUrl: "{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}",
      });

</script>

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
                    url : "{{route('admin.Appoin-detail-destroy')}}",
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


    //search confirm
    var selectstartage = '';
    for (let i = 19; i <= 40; i++) {
        selectstartage += "<option value='"+i+"'>"+i+"</option>";
        }
    $("#select-age-start").append(selectstartage);


    var htmlage = '';
    $('select[name="age_start"]').on('change',function(){
        var age_start = $(this).val();

        console.log(age_start);
        for (let i = 40; i >= age_start; i--) {
            htmlage += "<option value='"+i+"'>"+i+"</option>";
        }
        $("#select-age-end").html(htmlage);

    });


    $('.btn-search-confirm').on('click',function(){
        var keywords = $('#search-confirm').find('input[name="keywords"]').val();
        var gender = $('#search-confirm').find('select[name="gender"]').val();
        var age_start = $('#search-confirm').find('select[name="age_start"]').val();
        var age_end = $('#search-confirm').find('select[name="age_end"]').val();
        var book_id = $('#search-confirm').find('input[name="book_id"]').val();
        console.log(keywords);
        console.log(gender);
        console.log(age_start);
        console.log(age_end);
        $.ajax({
            url : "{{route('admin.appointment.search-confirm')}}",
            method: 'GET',
            data:{keywords:keywords,gender:gender,age_start:age_start,age_end:age_end,book_id:book_id},
            success:function(data){
                $('#list-search-confirm').html(data);
            }
        });
    });

    $(document).on('click', '.btn-bookdestroy', function(e){
        alert('destroy');
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
                    url : "{{route('admin.Appoin-detail-destroy')}}",
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
    </script>
    <script>
        $(document).ready(function(){



            Morris.Donut({
                element: 'donut',
                resize: true,
                colors: [
                    '#a8328e',
                    '#61a1ce',
                    '#ce8f61',
                    '#f5b942',
                    '#4842f5',
                ],
                data: [
                    {label:"Đơn lịch", value:{{ $Count_book }}},
                    {label:"Dịch vụ", value:{{ $Count_service }}},
                    {label:"Người giúp việc", value:{{ $Count_house }}},
                    {label:"Khách hàng", value:{{ $Count_user }}},
                    {label:"Bài viết", value:{{ $Count_blog }}}
                ]
            });


            chart60day();
            quickView();

            var chart = new Morris.Line({
            element: 'myfirstchart',
            lineColors: ['#819C79', '#fc8710', '#ff6541','#a4add3','#766b56'],
            barColors: ['#819C79', '#fc8710', '#ff6541','#a4add3','#766b56'],
            pointFillColors: ['#ffffff'],
            pointStrokeColors: ['black'],
            fillOpacity :0.6,
            hideHOver : 'auto',
            parseTime :false,

            xkey: 'date',
            ykeys: ['appointment','sales','profit'],
            behaveLikeLine: true,
            labels: ['Đơn lịch','Doanh thu','Lợi nhuận']
            });

            function chart60day() {
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url : "{{route('admin.thongke-dashboard-days')}}",
                    method: 'POST',
                    dataType: "JSON",
                    data:{_token:_token},
                    success:function(data)
                    {
                        chart.setData(data);
                    }
                });
            }

            function quickView() {
                $.ajax({
                    url : "{{route('admin.thongke-dashboard-quickview')}}",
                    method: 'GET',
                    dataType: "JSON",
                    success:function(data)
                    {
                        console.log(data);
                        $('.show-date-type').text(data['type']);
                        $('.show-date-total').text(data['book']);
                        $('.show-sales-type').text(data['type']);
                        $('.show-sales-total').text(new Intl.NumberFormat('en-US').format(data['sales']));
                        $('.show-profit-type').text(data['type']);
                        $('.show-profit-total').text(new Intl.NumberFormat('en-US').format(data['profit']));
                    }
                });

            }

            $('.dashboard-filter').on('change', function(e){
            var _token = $('input[name="_token"]').val();

                var dashboard_value = $(this).val();
                $.ajax({
                url : "{{route('admin.thongke-dashboard-filter')}}",
                method: 'POST',
                dataType: "JSON",
                data:{dashboard_value:dashboard_value,_token:_token},
                success:function(data)
                {
                    chart.setData(data);
                }
            });

            });


            $('.btn-dashboard-filter').on('click', function(e){
            var _token = $('input[name="_token"]').val();
            var from_date = $('input[name="from_date"]').val();
            var to_date = $('input[name="to_date"]').val();
            $.ajax({
                url : "{{route('admin.thongke-filter-by-date')}}",
                method: 'POST',
                dataType: "JSON",
                data:{from_date:from_date,to_date:to_date,_token:_token},
                success:function(data)
                {
                    console.log(data);
                    chart.setData(data);
                }
            });
        })



        $('a.total-book').on('click', function() {
            var type = $(this).data('type');
            $.ajax({
                    url : "{{route('admin.thongke-dashboard-book')}}",
                    method: 'GET',
                    dataType: "JSON",
                    data:{type:type},
                    success:function(data)
                    {
                        $('.show-date-type').text(data[0]);
                        $('.show-date-total').text(data[1]);
                    }
                });

                $.ajax({
                    url : "{{route('admin.thongke-dashboard-sales')}}",
                    method: 'GET',
                    dataType: "JSON",
                    data:{type:type},
                    success:function(data)
                    {
                        $('.show-sales-type').text(data[0]);
                        $('.show-sales-total').text(new Intl.NumberFormat('en-US').format(data[1]));
                    }
                });

                $.ajax({
                    url : "{{route('admin.thongke-dashboard-profit')}}",
                    method: 'GET',
                    dataType: "JSON",
                    data:{type:type},
                    success:function(data)
                    {

                        $('.show-profit-type').text(data[0]);
                        $('.show-profit-total').text(new Intl.NumberFormat('en-US').format(data[1]));
                    }
                });
            });

            $('a.total-sales').on('click', function() {
            var type = $(this).data('type');
            $.ajax({
                    url : "{{route('admin.thongke-dashboard-sales')}}",
                    method: 'GET',
                    dataType: "JSON",
                    data:{type:type},
                    success:function(data)
                    {
                        $('.show-sales-type').text(data[0]);
                        $('.show-sales-total').text(new Intl.NumberFormat('en-US').format(data[1]));
                    }
                });
            });

            $('a.total-profit').on('click', function() {
            var type = $(this).data('type');
            $.ajax({
                    url : "{{route('admin.thongke-dashboard-profit')}}",
                    method: 'GET',
                    dataType: "JSON",
                    data:{type:type},
                    success:function(data)
                    {

                        $('.show-profit-type').text(data[0]);
                        $('.show-profit-total').text(new Intl.NumberFormat('en-US').format(data[1]));
                    }
                });
            });
        })
    </script>

    </body>

</html>
