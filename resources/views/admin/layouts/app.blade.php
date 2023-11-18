@include('admin.layouts.header')

@include('admin.layouts.header_page')

@include('admin.layouts.siderbar')

  <!-- ======= Header ======= -->

  <!-- ======= Sidebar ======= -->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Trang chủ</a></li>
          <li class="breadcrumb-item active">Bảng điều khiển</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    @if (session('msg'))
    <div class="alert alert-{{session('style')}}"  role="alert">
        {{ session('msg') }}
    </div>
    @endif
   @yield('container')

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->


<footer id="footer" class="footer">
    <div class="copyright">
    &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer><!-- End Footer -->
@include('admin.layouts.footer')
