@extends('frontend.layouts.app')
@section('content')
<div class="card" style="text-align: center;width: 600px;margin: 0 auto">
    <button type="button" style="font-size: 200px" class="btn btn-{{$style}}">@if ($style == "success")
    <i class="bi bi-check-circle"></i>

    @else
    <i class="bi bi-exclamation-triangle"></i>
    @endif</button>
    <div class="card-body">
      <h5 class="card-title">{{ $msg}}</h5>

    <a href="{{ route('home.index') }}" class="btn btn-success" style="padding: 10px;width: 200px">Xác nhận</a>

    </div>
  </div>
@endsection
