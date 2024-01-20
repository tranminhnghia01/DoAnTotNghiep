


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-orange btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/moment-timezone.min.js') }}"></script>
    <script src="{{ asset('frontend/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="{{ asset('rate/js/jquery-1.9.1.min.js') }}"></script>
    <!-- Messenger Plugin chat Code -->

    {{-- <script src="js/jquery-1.9.1.min.js"></script> --}}
    <script>

    	$(document).ready(function(){
			//vote
            var Value = 0;
            $(document).on('click','.ratings_stars',function(){
                var Values =  $(this).find("input").val();
		        Value = Values;
                $(this).closest('div').find('span.rate-np').text(Values);
		    	if ($(this).hasClass('ratings_over')) {
		            $('.ratings_stars').removeClass('ratings_over');
		            $(this).prevAll().andSelf().addClass('ratings_over');
		        } else {
		        	$(this).prevAll().andSelf().addClass('ratings_over');
		        }
            });

            $(document).on({
                mouseenter: function () {
                    $(this).prevAll().andSelf().addClass('ratings_hover');

                },
                mouseleave: function () {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
                    //stuff to do on mouse leave
                }
            }, ".ratings_stars");


             // Đánh giá post
    $(document).on('click', '.btn-danhgia-post', function(e){
        var comment = $('textarea[name="comment"]').val();
        // alert(comment);
        if (Value == 0) {
            alert('Vui lòng đánh giá sao');
        }else{
            swal({
            title: "Đánh giá ??",
            text: 'Bạn có chắc muốn đánh giá!',
            icon: "success",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                var history_id = $(this).data('history-id');
                var _token = $('input[name="_token"]').val();
                console.log(history_id);
                console.log(comment);
                console.log(Value);
                console.log(_token);
                $.ajax({
                    url : "{{route('home.appointment.danhgia')}}",
                    method: 'POST',
                    data:{history_id:history_id,comment:comment,rate:Value,_token:_token},
                    success:function(data){
                        swal("Thành công! Bạn đã đánh giá đon thành công!", {
                            icon: "success",
                            });
                            window.setTimeout(function() {
                                location.reload();
                            },3000);
                        },
                        error: function (request, status, error) {
                            swal("Có lỗi xảy ra! Vui lòng kiểm tra lại thông tin.", {
                            icon: "danger",
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

        }





    });
		});
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
			//vote
            var address = '';
            $('.choose').on('change',function(){
            $("#address").val();

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
                url : "{{route('home.select-address')}}",
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

</body>

</html>
