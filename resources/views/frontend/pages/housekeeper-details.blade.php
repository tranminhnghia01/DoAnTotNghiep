@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="col-sm-12">
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
                                        <span class="rate-np" style="font-size: 26px;margin-top: -5px;margin-left: 10px">{{ $avg }}</span>
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
                    </div>
                </div>
            </div>
            @foreach ($comment as $key =>$val )
            <div class="comments">
                <h4 class="comment-title font-alt">Bình luận</h4>
                <div class="comment clearfix">
                  <div class="comment-avatar"><img src="{{ asset('uploads/users/'.$val->image) }}" alt="avatar" style="width: 50px;height: 50px;"></div>
                  <div class="comment-content clearfix">
                    <div class="comment-author font-alt"><a href="#">{{ $val->name }}</a></div>
                    <div class="comment-author font-alt"><a href="#">  @for ($i = 1 ; $i<=5 ;$i++)
                        @if ($i <= $val->rate)
                        <img src="{{ asset('rate/images/200/start-active.png') }}"  style="width: 10px">
                        @else
                        <img src="{{ asset('rate/images/200/start.png') }}" >

                        @endif
                    @endfor</a></div>


                    <div class="comment-body">
                      <p> {{ $val->comment }} </p>
                    </div>
                    <div class="comment-meta font-alt">{{ date('d/m/Y',strtotime($val->created_at))}} - <a href="#">Phản hồi</a>
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
                            <div class="comment-meta font-alt">{{ date('d/m/Y',strtotime($val->updated_at))}} - <a href="#">Phản hồi</a>
                            </div>
                        </div>
                    </div>
                  @endif

                </div>
              </div>
            @endforeach

            {{-- <div class="comment-form">
              <h4 class="comment-form-title font-alt">Add your comment</h4>
              <form method="post">
                <div class="form-group">
                  <label class="sr-only" for="name">Name</label>
                  <input class="form-control" id="name" type="text" name="name" placeholder="Name">
                </div>
                <div class="form-group">
                  <label class="sr-only" for="email">Name</label>
                  <input class="form-control" id="email" type="text" name="email" placeholder="E-mail">
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="comment" name="comment" rows="4" placeholder="Comment"></textarea>
                </div>
                <button class="btn btn-round btn-d" type="submit">Post comment</button>
              </form>
            </div> --}}
          </div>

    </div>
</div>
@endsection
