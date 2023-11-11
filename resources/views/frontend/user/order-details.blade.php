@extends('frontend.user.dashboard')
@section('profile')
<div class="dashboard-wrapper user-dashboard">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Tên</th>
                    <th>Người nhận</th>
                    <th>Trọng lượng(Kg)</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if (!empty($order_details))
                    @foreach ($order_details as $key=>$value )
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $value->product_id }}</td>
                        <td>{{ $value->product_name }}</td>
                        <td>{{ $value->product_price }}</td>
                        <td>{{ $value->product_sales_qty }} (Kg)</td>
                        @switch($order->order_status)
                                @case(1)
                                    <td><span class="label label-warning">Đang đợi xác nhận</span></td>
                                    @break
                                @case(2)
                                    <td><span class="label label-primary">Đã xác nhận </span></td>
                                    @break
                                @case(3)
                                    <td><span class="label label-danger">Đã hủy</span></td>
                                    @break
                                @default
                                    <td><span class="label label-success">Hoàn thành</span></td>
                            @endswitch
                    </tr>
                    @endforeach
                    <td>
                        <form >
                            @csrf
                    @if ($order->order_status == 4)
                        <button type="button"  class="btn btn-default"><i class="tf-ion-close" aria-hidden="true"> Đánh_giá</i></button>
                        @else
                            <button type="button" class="btn btn-default destroy-order" data-order-code="{{ $order->order_code }}"><i class="tf-ion-close" aria-hidden="true"> Hủy_đơn_hàng</i></button>
                        @endif
                        </form>
                    </td>
                @endif

            </tbody>
        </table>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('.destroy-order').on('click',function(e){
            e.preventDefault(); //cancel default action

    //Recuperate href value

    //pop up
    swal({
        title: "Hủy ??",
        text: 'Bạn có chắc muốn hủy đơn đặt hàng này!',
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        var order_code = $(this).data('order-code');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url : "{{route('home.account.order.destroy')}}",
            method: 'POST',
            data:{order_code:order_code,_token:_token},
            success:function(data){
                swal("Thành công! Đơn đặt hàng của bạn đã được hủy!", {
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
    });
</script>
@endsection
