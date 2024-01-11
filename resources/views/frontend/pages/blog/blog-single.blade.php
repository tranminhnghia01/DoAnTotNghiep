@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">


        <div class="row g-5">
            <div class="col-lg-12 wow fadeIn" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeIn;text-align: center">
                <p class="d-inline-block border rounded-pill py-1 px-4">Bài viết</p>
                <h1 class="mb-4">{{ $blog->blog_title }}</h1>
                    <h4 class="mb-4">
                        <img class="img-fluid rounded" src="{{ asset('uploads/blogs/'.$blog->blog_image) }}">
                    </h4>
                    <p class="role-4">{{ $blog->blog_des }}</p>

            </div>




            <div class="col-lg-12 wow fadeInUp service-content" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;width: 100%; margin: 0 auto">
                {!! $blog->blog_content !!}
                <style>
                    .service-content p img{
                        text-align: center !important;
                        margin: 0 auto;
                        width: 100% !important;
                    }
                </style>

                <nav>
                    <ul class="pagination justify-content-end">
                        @if ($previous)
                      <li class="page-item">

                        <a class="page-link" href="{{ route('home.blog.show',$previous) }}"><i class="fas fa-angle-double-left"></i></a>
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

                        <a  class="page-link" href="{{ route('home.blog.show',$next) }}"><i class="fas fa-angle-double-right"></i></a>
                      </li>

                        @else
                      <li class="page-item disabled">

                        <a class="page-link"  tabindex="-1" aria-disabled="true"><i class="fas fa-angle-double-right"></i></a>
                    </li>

                        @endif
                    </ul>
                </nav><!-- End Disabled and active states -->

            </div>

            <div class="col-sm-4">
                <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=61554815891622" data-tabs="message" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/profile.php?id=61554815891622" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=61554815891622">Website Dọn dẹp</a></blockquote></div>
            </div>
            <div class="col-sm-8">
                <div class="fb-comments" data-href="{{ route('home.blog.show',$blog->blog_id) }}" data-width="100%" data-numposts="20"></div>

            </div>
        </div>
	</div>
</section>
@endsection
