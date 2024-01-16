{{-- @extends('frontend.layouts.app')
@section('content')

@include('frontend.layouts.team')

@endsection --}}

@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Bài viết</p>
            <h1>Tất cả</h1>
        </div>
        <div class="row">
            <div class="col-sm-12">
              <div class="row multi-columns-row post-columns">
                @foreach ($housekeeper as $key=>$val)
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <a href="{{ route('home.home-housekeeper.show',$val->housekeeper_id) }}">

                    <div class="team-item position-relative rounded overflow-hidden">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="{{ asset('uploads/users/'.$val->image) }}" alt="" style="width: 100%; height: 300px">
                        </div>
                        <div class="team-text bg-light text-center p-4">
                            <h5>{{  $val->name }}</h5>

                            <div class="team-social text-center">
                                <a class="btn btn-square" href=""><i class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-twitter"></i></a>
                                <a class="btn btn-square" href=""><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
            </a>

                </div>
                @endforeach
                {{ $housekeeper->links('pagination::bootstrap-5') }}
                  <nav>
              </div>

            </div>
            {{-- <div class="col-sm-4 ">

              <div class="widget">
                <div class="input-group mb-3">
                    <form action="" style="width: 100%;">
                        <input type="text" class="form-control" placeholder="Search..." style="float: left;width: 85%">
                        <button type="submit" class="input-group-text" style="font-size: 24px;" ><i class="fa fa-search"></i></button>
                    </form>
                </div>
              </div>
              <div class="widget">
                <h5 class="widget-title font-alt">Danh mục bài viết</h5>
                <ul class="icon-list">
                  <li><a href="#">Photography - 7</a></li>
                  <li><a href="#">Web Design - 3</a></li>
                  <li><a href="#">Illustration - 12</a></li>
                  <li><a href="#">Marketing - 1</a></li>
                  <li><a href="#">Wordpress - 16</a></li>
                </ul>
              </div>
              <div class="widget">
                <h5 class="widget-title font-alt">Bài viết phổ biến</h5>
                <ul class="widget-posts">
                  <li class="clearfix">
                    <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-3.jpg" alt="Post Thumbnail" style="width: 64px;height: 64px"/></a></div>
                    <div class="widget-posts-body">
                      <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                      <div class="widget-posts-meta">23 january</div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="widget">
                <h5 class="widget-title font-alt">Những ý kiến gần đây</h5>
                <ul class="icon-list">
                  <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                  <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                  <li>Andy on <a href="#">Eco bag Mockup</a></li>
                  <li>Jack on <a href="#">Bottle Mockup</a></li>
                  <li>Mark on <a href="#">Our trip to the Alps</a></li>
                </ul>
              </div>
            </div> --}}
          </div>
    </div>
</div>
@endsection



