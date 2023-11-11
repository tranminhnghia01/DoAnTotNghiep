@extends('frontend.user.dashboard')
@section('profile')
    <div class="dashboard-wrapper dashboard-user-profile">
        <div class="media">
            <div class="pull-left text-center" href="#!">
                <img class="media-object user-img" src=" {{ asset('uploads/users/'.Auth::user()->avatar) }} "style="height: 180px" alt="Image">
                <a href="#x" class="btn btn-transparent mt-20">Change Image</a>
            </div>
            <div class="media-body">
                <ul class="user-profile-list">
                    <li><span>Full Name:</span>{{ $user->name }}</li>
                    <li><span>Address:</span>{{ $user->address }}</li>
                    <li><span>Email:</span>{{ $user->email }}</li>
                    <li><span>Phone:</span>{{ $user->phone }}</li>
                    <a href="{{ route('home.account.edit',$user->id) }}" class="btn btn-primary">Chỉnh sửa</a>
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection
