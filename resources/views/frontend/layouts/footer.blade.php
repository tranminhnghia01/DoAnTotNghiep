


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
    <script type="text/javascript">
        $(document).ready(function(){

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
