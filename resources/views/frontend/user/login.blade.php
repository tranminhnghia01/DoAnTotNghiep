@extends('frontend.layouts.blocks.app')
    @section('content')
    @if (session('msg'))
    <div class="alert alert-{{session('style')}}">
        {{ session('msg') }}
    </div>
    @endif
    <section class="signin-page account">
        <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
            <div class="block text-center">
                <a class="logo" href="index.html">
                <img src="images/logo.png" alt="">
                </a>
                <h2 class="text-center">Welcome Back</h2>
                <form class="text-left clearfix" action="" method="POST" >
                    @csrf
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-main text-center" >Login</button>
                    </div>
                </form>
                <p class="mt-20">New in this site ?<a href="{{ route('home.register') }}"> Create New Account</a></p>
            </div>
            </div>
        </div>
        </div>
    </section>
@endsection
{{-- @include('frontend.layouts.header')

<section class="signin-page account">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="block text-center">
            <a class="logo" href="index.html">
              <img src="images/logo.png" alt="">
            </a>
            <h2 class="text-center">Welcome Back</h2>
            <form class="text-left clearfix" action="" method="POST" >
                @csrf
                <div class="form-group">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-main text-center" >Login</button>
                </div>
            </form>
            <p class="mt-20">New in this site ?<a href="{{ route('home.register') }}"> Create New Account</a></p>
          </div>
        </div>
      </div>
    </div>
  </section>

@include('frontend.layouts.footer') --}}
