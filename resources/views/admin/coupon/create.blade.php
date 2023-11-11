@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Coupon</h4>

<!-- Basic Layout -->
<div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Create Coupon</h5>
        <small class="text-muted float-end">Default</small>
      </div>
        @if (session('msg'))
            <div class="alert alert-{{session('style')}}">
            {{ session('msg') }}
            </div>
         @endif

      <div class="card-body ">
        <form action="{{ route('admin.coupon.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="coupon_name" placeholder="coupon name" />
              @error('coupon_name')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Code</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="coupon_code" placeholder="coupon code" />
              @error('coupon_code')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Quantity</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="basic-default-name" name="coupon_qty" placeholder="quantity" />
              @error('coupon_qty')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Method</label>
            <div class="col-sm-2">
                <select class="form-select" id="inputGroupSelect01" name="coupon_method">
                    <option selected value="0">%</option>
                    <option value="1">Money</option>
                  </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Number</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" id="basic-default-name" name="coupon_number" placeholder="" />
              @error('coupon_number')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Descriptons</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="coupon_des" />
              </div>
              @error('coupon_des')
              <span style="color: red">{{ $message }}</span>
            @enderror
              <div class="form-text">You can use letters, numbers & periods</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message" >Content</label>
            <div class="col-sm-10">
              <textarea name="coupon_content" id="coupon_content" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" ></textarea>
              @error('coupon_content')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Options</label>
            <div class="col-sm-10">
                <select class="form-select" id="inputGroupSelect01" name="coupon_status">
                    <option selected value="0">Active</option>
                    <option value="1">InActive</option>
                  </select>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Send</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
