
@extends('frontend.layouts.blocks.app')
@section('content')
<div class="page-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
                @foreach ($blog as $key=>$value)
                <div class="post">
                    <div class="post-media post-thumb">
                        <a href="blog-single.html">
                            <img src="{{ asset('uploads/blogs/'.$value->blog_image) }}" alt="" style="height: 450px">
                        </a>
                    </div>
                    <h2 class="post-title"><a href="blog-single.html"> {{ $value->blog_title }}</a></h2>
                    <div class="post-meta">
                        <ul>
                            <li>
                                <i class="tf-ion-ios-calendar"></i> 20, MAR 2017
                            </li>
                            <li>
                                <i class="tf-ion-android-person"></i> POSTED BY ADMIN
                            </li>
                            <li>
                                <a href="#!"><i class="tf-ion-ios-pricetags"></i> LIFESTYLE</a>,<a href="#!"> TRAVEL</a>, <a href="#!">FASHION</a>
                            </li>
                            <li>
                                <a href="#!"><i class="tf-ion-chatbubbles"></i> 4 COMMENTS</a>
                            </li>
                        </ul>
                    </div>
                    <div class="post-content">
                        <p>{{ $value->blog_des }}</p>
                        <a href="{{ route('home.Blog.show',$value->id) }}" class="btn btn-main">Chi tiết</a>
                    </div>
                </div>
                @endforeach
                <div class="text-center">
                    {{ $blog->links('pagination::bootstrap-4') }}
                </div>
            </div>
      		<div class="col-md-4">
				<aside class="sidebar">
	<div class="widget widget-subscription">
		<h4 class="widget-title">Get notified updates</h4>
		<form>
		  <div class="form-group">
		    <input type="email" class="form-control" placeholder="Your Email Address">
		  </div>
		  <button type="submit" class="btn btn-main">I am in</button>
		</form>
	</div>

	<!-- Widget Latest Posts -->
	<div class="widget widget-latest-post">
		<h4 class="widget-title">Latest Posts</h4>
		<div class="media">
			<a class="pull-left" href="#!">
				<img class="media-object" src="images/blog/post-thumb.jpg" alt="Image">
			</a>
			<div class="media-body">
				<h4 class="media-heading"><a href="#!">Introducing Swift for Mac</a></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, officia.</p>
			</div>
		</div>
		<div class="media">
			<a class="pull-left" href="#!">
				<img class="media-object" src="images/blog/post-thumb-2.jpg" alt="Image">
			</a>
			<div class="media-body">
				<h4 class="media-heading"><a href="#!">Welcome to Themefisher Family</a></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, officia.</p>
			</div>
		</div>
		<div class="media">
			<a class="pull-left" href="#!">
				<img class="media-object" src="images/blog/post-thumb-3.jpg" alt="Image">
			</a>
			<div class="media-body">
				<h4 class="media-heading"><a href="#!">Warm welcome from swift</a></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, officia.</p>
			</div>
		</div>
		<div class="media">
			<a class="pull-left" href="#!">
				<img class="media-object" src="images/blog/post-thumb.jpg" alt="Image">
			</a>
			<div class="media-body">
				<h4 class="media-heading"><a href="#!">Introducing Swift for Mac</a></h4>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quis, officia.</p>
			</div>
		</div>
	</div>
	<!-- End Latest Posts -->

	<!-- Widget Category -->
	<div class="widget widget-category">
		<h4 class="widget-title">Danh mục dịch vụ</h4>
		<ul class="widget-category-list">
            @foreach ($category as $val)
	            <li><a href="#!"> {{ $val->category_name }} </a></li>
            @endforeach
	    </ul>
	</div> <!-- End category  -->

	<!-- Widget tag -->
	<div class="widget widget-tag">
		<h4 class="widget-title">Tag Cloud</h4>
		<ul class="widget-tag-list">
	        <li><a href="#!">Animals</a>
	        </li>
	        <li><a href="#!">Landscape</a>
	        </li>
	        <li><a href="#!">Portrait</a>
	        </li>
	        <li><a href="#!">Wild Life</a>
	        </li>
	        <li><a href="#!">Video</a>
	        </li>
	    </ul>
	</div> <!-- End tag  -->







</aside>
      		</div>
		</div>
	</div>
</div>

@endsection
