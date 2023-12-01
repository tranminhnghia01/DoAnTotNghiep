   <!-- Topbar Start -->
   <div class="container-fluid bg-light p-0 wow fadeIn" data-wow-delay="0.1s">
    <div class="row gx-0 d-none d-lg-flex">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-map-marker-alt text-orange me-2"></small>
                <small>123 Street, New York, USA</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center py-3">
                <small class="far fa-clock text-orange me-2"></small>
                <small>Mon - Fri : 09.00 AM - 09.00 PM</small>
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center py-3 me-4">
                <small class="fa fa-phone-alt text-orange me-2"></small>
                <small>+012 345 6789</small>
            </div>
            <div class="h-100 d-inline-flex align-items-center">
                <a class="btn btn-sm-square rounded-circle bg-white text-orange me-1" href=""><i class="fab fa-facebook-f"></i></a>
                <a class="btn btn-sm-square rounded-circle bg-white text-orange me-1" href=""><i class="fab fa-twitter"></i></a>
                <a class="btn btn-sm-square rounded-circle bg-white text-orange me-1" href=""><i class="fab fa-linkedin-in"></i></a>
                <a class="btn btn-sm-square rounded-circle bg-white text-orange me-0" href=""><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
    <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <h1 class="m-0 text-orange"><i class="fas fa-braille me-3"></i>Shop</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="" class="nav-item nav-link active">Trang chủ</a>
            <a href="about.html" class="nav-item nav-link">Về chúng tôi</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Dịch vụ</a>
                <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                    {{-- @foreach ($list_service as $val )
                        <a href="Moon.com/{{$val->service_slug}}" class="dropdown-item">{{ $val->service_name }}</a>
                    @endforeach --}}
                </div>
            </div>
            <a href="service.html" class="nav-item nav-link">Kinh nghiệm hay</a>
            <a href="contact.html" class="nav-item nav-link">Liên Hệ</a>
        <a href="contact.html" class="nav-item nav-link">Trở thành đối tác</a>
        </div>
        @if (Auth::check())
        <div class="nav-item dropdown">
            <a href="#" class="btn btn-orange rounded-0 py-4 px-lg-5 d-none d-lg-block nav-link dropdown-toggle"  data-bs-toggle="dropdown">{{ Auth::user()->name }}<i class="fas fa-user" style="padding-left: 10px;"></i></a>
            <div class="dropdown-menu rounded-0 rounded-bottom m-0" style="width: 90%">
                    <a style="padding:8px" href="" class="dropdown-item"><i class="fas fa-user-cog"  style="padding-right: 10px"></i>Cài đặt</a>
                    <a style="padding:8px" href="{{ route('home.appointment.index') }}" class="dropdown-item"><i class="fas fa-tasks"  style="padding-right: 10px"></i>Quản lý đơn</a>
                    <a style="padding:8px" href="{{ route('home.logout') }}" class="dropdown-item"><i class="fas fa-sign-out-alt"  style="padding-right: 10px"></i>Đăng xuất</a>
            </div>
        </div>
        @else
        <a href="{{ route('home.login') }}" class="btn btn-orange rounded-0 py-4 px-lg-5 d-none d-lg-block">Đăng nhập| Đăng ký<i class="fa fa-arrow-right ms-3"></i></a>
        @endif
    </div>
</nav>
<!-- Navbar End -->
