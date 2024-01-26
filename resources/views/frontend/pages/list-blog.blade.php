@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Bài viết</p>
            <h1>Tất cả</h1>
        </div>
        <div class="row">
            <div class="col-sm-8">
              <div class="row multi-columns-row post-columns">
                  @foreach ($blog as $key=>$value)
                  <div class="col-md-6 col-lg-6">
                      <div class="post">
                        <div class="post-thumbnail"><a href=""><img src="{{ asset('uploads/blogs/'.$value->blog_image) }}" alt="Blog-post Thumbnail" style="width: 100%;height: 210px;"/></a></div>
                        <div class="post-header font-alt">
                          <h2 class="post-title"><a href="">{{ $value->blog_title }}</a></h2>
                          <div class="post-meta">By&nbsp;<a href="">Mark Stone</a>&nbsp;| 23 November | 3 Comments
                          </div>
                        </div>
                        <div class="post-entry">
                          <p> {{ $value->blog_des }} </p>
                        </div>
                        <div class="post-more"><a class="more-link" href="{{ route('home.blog.show',$value->blog_id) }}">Đọc tiếp</a></div>
                      </div>
                    </div>
                  @endforeach
                  <nav>
                    {{-- <ul class="pagination justify-content-end">
                        {{ $blog->links() }}
                    </ul> --}}
                  {{-- </nav><!-- End Disabled and active states --> --}}
                  <div >
                    {{ $blog->links('pagination::bootstrap-4') }}
                  </div>
              </div>

            </div>
            <div class="col-sm-4 ">

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
                  <li><a href="">Photography - 7</a></li>
                  <li><a href="">Web Design - 3</a></li>
                  <li><a href="">Illustration - 12</a></li>
                  <li><a href="">Marketing - 1</a></li>
                  <li><a href="">Wordpress - 16</a></li>
                </ul>
              </div>
              <div class="widget">
                <h5 class="widget-title font-alt">Bài viết phổ biến</h5>
                <ul class="widget-posts">
                  <li class="clearfix">
                    <div class="widget-posts-image"><a href=""><img src="assets/images/rp-3.jpg" alt="Post Thumbnail" style="width: 64px;height: 64px"/></a></div>
                    <div class="widget-posts-body">
                      <div class="widget-posts-title"><a href="">Designer Desk Essentials</a></div>
                      <div class="widget-posts-meta">23 january</div>
                    </div>
                  </li>
                </ul>
              </div>
              <div class="widget">
                <h5 class="widget-title font-alt">Những ý kiến gần đây</h5>
                <ul class="icon-list">
                  <li>Maria on <a href="">Designer Desk Essentials</a></li>
                  <li>John on <a href="">Realistic Business Card Mockup</a></li>
                  <li>Andy on <a href="">Eco bag Mockup</a></li>
                  <li>Jack on <a href="">Bottle Mockup</a></li>
                  <li>Mark on <a href="">Our trip to the Alps</a></li>
                </ul>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

