<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Người giúp việc nổi bật</p>
            <h1>Người giúp việc của chúng tôi</h1>
        </div>
        <div class="row g-4">
            @foreach ($housekeeper as $key=>$val)
            <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
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


        </div>
    </div>
</div>
