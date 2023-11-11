@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> product</h4>

<!-- Basic Layout -->
<div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Create Product</h5>
        <small class="text-muted float-end">Default</small>
      </div>
        @if (session('msg'))
            <div class="alert alert-{{session('style')}}">
            {{ session('msg') }}
            </div>
         @endif

      <div class="card-body ">
        <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">Product ID</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" name="product_id" placeholder="product id" />
                  @error('product_id')
                    <span style="color: red">{{ $message }}</span>
                  @enderror
                </div>
              </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="product_name" placeholder="product name" />
              @error('product_name')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Image</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="basic-default-company" placeholder="ACME Inc." name="product_image[]" multiple="multiple" />
              @error('product_image')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Price</label>
            <div class="col-sm-4">
                <div class="col-sm-10 input-group">
                    <input type="text" class="form-control" id="basic-default-name" name="product_price" placeholder="product price" />
                    <span class="input-group-text">$</span>
                    <span class="input-group-text">0.00</span>
                </div>
              @error('product_price')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Quantity</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" id="basic-default-name" name="product_qty" placeholder="product qty" />
              @error('product_qty')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Slug</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="product_slug" placeholder="product slug" />
              @error('product_slug')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Tags</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" data-role="tagsinput" id="basic-default-name" name="product_tags" />
              @error('product_tags')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>


          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Descriptons</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="product_des" />
              </div>
              @error('product_des')
              <span style="color: red">{{ $message }}</span>
            @enderror
              <div class="form-text">You can use letters, numbers & periods</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message" >Content</label>
            <div class="col-sm-10">
              <textarea name="product_content" id="blog_content" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" ></textarea>
              @error('product_content')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Category</label>
            <div class="col-sm-10">
                <select class="form-select" id="inputGroupSelect01" name="category_id">
                    <option selected value="0">Parent</option>
                    @foreach ($categories as $item => $val )
                        <option value="{{ $val->id }}"> {{ $val->category_name }} </option>
                    @endforeach
                  </select>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Status</label>
            <div class="col-sm-4">
                <select class="form-select status" id="inputGroupSelect01" name="product_status">
                    <option selected value="0">Hiện</option>
                    <option value="1">Ẩn</option>
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
<script>

</script>
@endsection
