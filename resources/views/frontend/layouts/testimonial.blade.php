<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Lời chứng thực</p>
            <h1>Người dùng của chúng tôi nói gì!</h1>
        </div>
        <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
            @foreach ($comment_home as $key=>$comment )
            <div class="testimonial-item text-center">
                <img class="img-fluid bg-light rounded-circle p-2 mx-auto mb-4" src="{{ asset('uploads/users/'.$comment->image) }}" style="width: 100px; height: 100px;">
                <div class="testimonial-text rounded text-center p-4">
                    <p>{{ $comment->comment }}</p>
                    <h5 class="mb-1">{{ $comment->name }}</h5>
                    <span class="fst-italic">Chuyên nghiệp</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
