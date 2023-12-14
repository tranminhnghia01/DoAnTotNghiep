
@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Thông tin cá nhân</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Lịch sử đơn lịch</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="notify-tab" data-bs-toggle="tab" data-bs-target="#notify" type="button" role="tab" aria-controls="notify" aria-selected="false">Thông báo</button>
                  </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    @include('frontend.setting.profile-edit')
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                    @include('frontend.setting.Appointment')
                </div>
              </div>
        </div>
    </div>
</div>

  @endsection
