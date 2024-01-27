@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cập nhật dịch vụ</h5>
            <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>

            <!-- Table with stripped rows -->
      <div class="card-body ">
        <form action="{{ route('admin.service.update',$service->service_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Tên dịch vụ</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="service_name" placeholder="service name" value="{{ $service->service_name }}" />
              @error('service_name')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Hình ảnh</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="basic-default-company" placeholder="ACME Inc." name="service_image" />
              @error('service_image')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Tên Slug</label>
            <div class="col-sm-10">
            <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="service_slug" value="{{ $service->service_slug }}"/>
            </div>
            @error('service_slug')
            <span style="color: red">{{ $message }}</span>
            @enderror
            <div class="form-text">You can use letters, numbers & periods</div>
            </div>
        </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Mô tả</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="service_des" value="{{ $service->service_des }}" />
              </div>
              @error('service_des')
              <span style="color: red">{{ $message }}</span>
            @enderror
              <div class="form-text">You can use letters, numbers & periods</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Giá dịch vụ/ 1h</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="service_price" value="{{ $service->service_price }}"/>
              </div>
              @error('service_price')
              <span style="color: red">{{ $message }}</span>
            @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message" >Nội dung</label>
            <div class="col-sm-10">
              <textarea name="service_content" id="blog_content" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" >{{ $service->service_content }}</textarea>
              @error('service_content')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Trạng thái</label>
            <div class="col-sm-10">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="service_status" @if ($service->service_status == "on")
                    checked
                  @endif>
                  <label class="form-check-label" for="flexSwitchCheckDefault">Kích hoạt</label>
                </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Cập nhật</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
