@extends('frontend.layouts.blocks.app')
@section('content')

<section class="user-dashboard page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<ul class="list-inline dashboard-menu text-center">
					<li><a class="active menu-db" href="{{ route('home.account.index') }}">Thông tin cá nhân</a></li>
					<li><a class="menu-db" href="{{ route('home.account.order.index') }}">Đơn hàng</a></li>
				</ul>
                @yield('profile')
			</div>
		</div>
	</div>
</section>


</section>


<script>
    $(document).ready(function(){
        $('.menu-db').click(function(){
            $('.menu-db').removeClass('active');
            $(this).addClass('active');
        });

        $('.nav-item').click(function(){
            $('.nav-item').removeClass('active');
            $(this).addClass('active');
        });
    })
</script>
@endsection
