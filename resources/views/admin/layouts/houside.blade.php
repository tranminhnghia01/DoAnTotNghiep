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
        <a class="nav-link collapsed" href="{{ route('admin.Appoin-profile') }}">
          <i class="bi bi-person"></i>
          <span>Cài đặt tài khoản</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-heading">Chức năng</li>
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.Appoin-index') }}">
          <i class="bi bi-calendar-date"></i>
          <span>Danh sách đơn lịch</span>
        </a>
      </li><!-- End Profile Page Nav -->
      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.Appoin-bill') }}">
          <i class="bi bi-calendar-date"></i>
          <span>Hóa đơn</span>
        </a>
      </li><!-- End Profile Page Nav --> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-calendar-date"></i><span>Hóa đơn</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.Appoin-bill') }}">
              <i class="bi bi-circle"></i><span>Chưa duyệt</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.Appoin-bill-processing') }}">
              <i class="bi bi-circle"></i><span>Đã duyệt</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav -->
    </ul>

  </aside><!-- End Sidebar-->
