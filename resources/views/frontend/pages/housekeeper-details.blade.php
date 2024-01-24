@extends('frontend.layouts.app')
@section('content')

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeIn;">
                    <div class="d-flex flex-column">
                        <img class="img-fluid rounded" src="{{ asset('uploads/users/'.$housekeeper->image) }}"  style="width: 80%;">
                        <div class="rate" style="padding: 12px 10px;">
                            <div class="vote">
                                @for ($i = 1 ; $i<=5 ;$i++)
                                <div class="star_{{$i}} ratings_stars
                                    @if ($i <= $avg+0.5)
                                    ratings_over
                                    @endif
                                " style="background-size: 30px;height: 30px;width: 30px;">
                                    <input value="{{$i}}" type="radio" name="rate" hidden>
                                </div>
                                @endfor
                                <span class="rate-np" style="font-size: 26px;margin-top: -5px;margin-left: 10px">{{ round($avg,1) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 wow fadeIn" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;">
                    <p class="d-inline-block border rounded-pill py-1 px-4">Người giúp việc</p>
                    <h1 class="mb-4">Tổng quan về người giúp việc!</h1>
                        <h4 class="mb-4">Họ tên: {{ $housekeeper->name }}</h4>
                        <p class="role-4">{{ $housekeeper->des }}
                        </p>
                        <p><i class="far fa-check-circle text-orange me-3"></i>Số điện thoại: {{ $housekeeper->phone }}</p>
                        <p><i class="far fa-check-circle text-orange me-3"></i>Tuổi: {{ $housekeeper->age }}</p>
                        <p><i class="far fa-check-circle text-orange me-3"></i>Địa chỉ liên hệ: {{ $housekeeper->address }}</p>

                </div>

                <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;font-size: 20px;">
                    <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">

                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview" aria-selected="true" role="tab">Mô tả</button>
                        </li>

                        <li class="nav-item" role="presentation">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="false" role="tab" tabindex="-1">Phản hồi</button>
                        </li>
                      </ul>
                      <div class="tab-content pt-2">

                        <div class="tab-pane fade profile-overview active show" id="profile-overview" role="tabpanel" style="margin-top: 20px !important">
                          <h2 class="card-title">Chi tiết người giúp việc</h2>

                            {!! $housekeeper->content !!}
                        </div>

                        <div class="tab-pane fade profile-edit" id="profile-edit" role="tabpanel">
                            <div class="comments" style="margin-top: 20px !important">
                          <h2 class="card-title">Bình luận </h2>

                                @foreach ($comment as $key =>$val )

                                    <div class="comment clearfix">
                                    <div class="comment-avatar"><img src="{{ asset('uploads/users/'.$val->image) }}" alt="avatar" style="width: 50px;height: 50px;"></div>
                                    <div class="comment-content clearfix">
                                    <div class="comment-author font-alt"><a href="#">{{ $val->name }}</a></div>
                                    <div class="comment-author font-alt"><a href="#">  @for ($i = 1 ; $i<=5 ;$i++)
                                        @if ($i <= $val->rate)
                                        <img src="{{ asset('rate/images/200/start-active.png') }}"  style="width: 10px">
                                        @else
                                        <img src="{{ asset('rate/images/200/start.png') }}" style="width: 10px">

                                        @endif
                                    @endfor</a></div>


                                    <div class="comment-body">
                                        <p> {{ $val->comment }} </p>
                                    </div>
                                    <div class="comment-meta font-alt">{{ date('d/m/Y',strtotime($val->created_at))}}
                                    </div>
                                    </div>
                                    @if ($val->reply)
                                    <div class="comment clearfix">
                                        <div class="comment-avatar"><img src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="avatar" style="width: 50px;height: 50px;"></div>
                                        <div class="comment-content clearfix">
                                            <div class="comment-author font-alt">
                                                <a href="#">Quản trị viên</a>
                                            </div>
                                            <div class="comment-body">
                                                <p>{{ $val->reply }}</p>
                                            </div>
                                            <div class="comment-meta font-alt">{{ date('d/m/Y',strtotime($val->updated_at))}}
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    </div>
                                @endforeach

                            </div>
                        </div>

                      </div><!-- End Bordered Tabs -->

                    <nav>
                        <ul class="pagination justify-content-end">
                            @if ($previous)
                          <li class="page-item">

                            <a class="page-link" href="{{ route('home.home-housekeeper.show',$previous) }}"><i class="fas fa-angle-double-left"></i></a>
                          </li>
                            @else
                          <li class="page-item disabled">

                            <a class="page-link" tabindex="-1" aria-disabled="true"><i class="fas fa-angle-double-left"></i></a>
                        </li>


                            @endif

                            <li class="page-item"><a class="page-link">1</a></li>
                            <li class="page-item"><a class="page-link">2</a></li>
                            <li class="page-item"><a class="page-link">3</a></li>
                            @if ($next)
                          <li class="page-item">

                            <a  class="page-link" href="{{ route('home.home-housekeeper.show',$next) }}"><i class="fas fa-angle-double-right"></i></a>
                          </li>

                            @else
                          <li class="page-item disabled">

                            <a class="page-link"  tabindex="-1" aria-disabled="true"><i class="fas fa-angle-double-right"></i></a>
                        </li>

                            @endif
                        </ul>
                      </nav><!-- End Disabled and active states -->

                </div>
            </div>
        </div>
    </div>

@endsection
