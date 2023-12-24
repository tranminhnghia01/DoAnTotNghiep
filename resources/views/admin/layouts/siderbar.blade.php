<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="index.html">
          <i class="bi bi-grid"></i>
          <span>Bảng điều khiển</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.account') }}">
          <i class="bi bi-person"></i>
          <span>Cài đặt tài khoản</span>
        </a>
      </li><!-- End Profile Page Nav -->
      <li class="nav-heading">Quản lý</li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-file-list-3-line"></i><span>Dịch vụ</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.service.index') }}">
              <i class="bi bi-circle"></i><span>Danh sách</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.service.create') }}">
              <i class="bi bi-circle"></i><span>Thêm</span>
            </a>
          </li>
        </ul>
    </li><!-- End Tables Nav -->
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#appointment-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-calendar-date"></i></i><span>Danh sách đơn lịch</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="appointment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.appointment.index') }}">
              <i class="bi bi-circle"></i><span>Mới</span>
            </a>
          </li>

        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#billprocessing-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-calendar-date"></i></i><span>Hóa đơn</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="billprocessing-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.hoadon') }}">
              <i class="bi bi-circle"></i><span>Chưa duyệt</span>
            </a>
          </li>

          <li>
            <a href="{{ route('admin.hoadon-processing') }}">
              <i class="bi bi-circle"></i><span>Đã duyệt</span>
            </a>
          </li>

        </ul>
      </li><!-- End Icons Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#chartsnav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Thống kê</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="chartsnav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.thongke-index') }}">
              <i class="bi bi-circle"></i><span>Thống kê</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Tài khoản</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.Nguoi-dung.index') }}">
              <i class="bi bi-circle"></i><span>Khách hàng</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.housekeeper.index') }}">
              <i class="bi bi-circle"></i><span>Người giúp việc</span>
            </a>
          </li>
        </ul>
      </li><!-- End Icons Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#comment-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Bình luận/ Đánh giá</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="comment-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.comment.index') }}">
              <i class="bi bi-circle"></i><span>Danh sách</span>
            </a>
          </li>

        </ul>
      </li><!-- End Icons Nav -->




      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="ri-coupon-3-line"></i><span>Mã giảm giá</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.coupon.index') }}">
              <i class="bi bi-circle"></i><span>Mã giảm giá</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Bài viết</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="components-progress.html">
              <i class="bi bi-circle"></i><span>Progress</span>
            </a>
          </li>
          <li>
            <a href="components-spinners.html">
              <i class="bi bi-circle"></i><span>Spinners</span>
            </a>
          </li>
          <li>
            <a href="components-tooltips.html">
              <i class="bi bi-circle"></i><span>Tooltips</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" href="#">
          <i class="bi bi-envelope"></i>
          <span>Liên hệ</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.banggia.index') }}">
          <i class="ri-price-tag-2-line"></i>
          <span>Bảng giá</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->
