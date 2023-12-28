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

            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;width: 100%; margin: 0 auto">
                {!! $blog->blog_content !!}
            </div>
        </div>

	</div>
</section>
@endsection
