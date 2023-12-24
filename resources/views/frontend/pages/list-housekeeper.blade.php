@extends('frontend.layouts.app')
@section('content')
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px; visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Người Giúp việc</p>
            <h1>Kinh nghiệm của chúng tôi</h1>
        </div>
        <div class="row g-4">
        @foreach ($housekeeper as $key=>$value)
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s" style="visibility: visible; animation-delay: 0.1s; animation-name: fadeInUp;">
                <div class="team-item position-relative rounded overflow-hidden">
                    <div class="overflow-hidden">
                        <img class="img-fluid" src="{{ asset('uploads/users/'.$value->image) }}" alt="" style="width: 100%; height: 300px">
                    </div>
                    <div class="team-text bg-light text-center p-4">
                        <h5>{{ $value->name }}</h5>
                        <a href="{{ route('home.home-housekeeper.show',$value->housekeeper_id) }}" class="text-orange">Người giúp việc</a>
                        <div class="team-social text-center">
                            <a class="btn btn-square"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
    </div>
</div>
@endsection

