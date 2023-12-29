<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex flex-column">
                    <img class="img-fluid rounded w-75 align-self-end" src="{{ asset('frontend/img/trongtre.png') }}" alt="">
                    <img class="img-fluid rounded w-50 bg-white pt-3 pe-3" src="{{ asset('frontend/img/about2.png') }}" alt="" style="margin-top: -25%;">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <p class="d-inline-block border rounded-pill py-1 px-4">Về chúng tôi</p>
                <h1 class="mb-4">Tại sao bạn nên tin tưởng chúng tôi? Tìm hiểu về chúng tôi!</h1>
                <p>Là dịch vụ đầu tiên bTaskee triển khai. Giờ đây công việc dọn dẹp không còn là nỗi bận tâm, bạn sẽ có nhiều thời gian nghỉ ngơi và tận hưởng cuộc sống. <br>
                    Xử lý chuyên sâu mọi vết bẩn trong căn nhà của bạn. <br>
                    Việc mua sắm thực phẩm và đồ dùng gia đình trở nên tiện lợi hơn bao giờ hết. Giao hàng tận nơi chỉ sau 1h. <br>
                    Giúp cải thiện chất lượng không khí, giảm mức tiêu thụ điện năng và tăng tuổi thọ máy lạnh tại nhà hay phòng làm việc của bạn. <br>
                </p>
                <p class="mb-4">An tâm với lựa chọn của bạn.</p>
                <p><i class="far fa-check-circle text-orange me-3"></i>Đặt lịch nhanh chóng</p>
                <p><i class="far fa-check-circle text-orange me-3"></i>Giá cả rõ ràng</p>
                <p><i class="far fa-check-circle text-orange me-3"></i>Đa dạng dịch vụ</p>
                <p><i class="far fa-check-circle text-orange me-3"></i>An toàn tối đa</p>
                <a class="btn btn-orange rounded-pill py-3 px-5 mt-3" href="">Tìm hiểu thêm</a>
                <form action="{{ route('home.momo') }}" method="post">
                    @csrf
                    <button type="submit" name="redirect">thanh toán</button>
                </form>

                <form action="{{ route('home.onepay') }}" method="post">
                    @csrf
                    <button type="submit" >thanh toán</button>
                </form>
            </div>
        </div>
    </div>
</div>
