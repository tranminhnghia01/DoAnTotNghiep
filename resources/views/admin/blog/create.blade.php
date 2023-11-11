@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Bài viết</h4>

<!-- Basic Layout -->
<div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Thêm mới bài viết</h5>
        <small class="text-muted float-end">Default</small>
      </div>
        @if (session('msg'))
            <div class="alert alert-{{session('style')}}">
            {{ session('msg') }}
            </div>
         @endif

      <div class="card-body">
        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="basic-default-name">ID Blog</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="basic-default-name" name="blog_id" placeholder="blog id" />
                  @error('blog_id')
                    <span style="color: red">{{ $message }}</span>
                  @enderror
                </div>
              </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Title</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="blog_title" placeholder="blog title" />
              @error('blog_title')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Image</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="basic-default-company" placeholder="ACME Inc." name="blog_image" />
              @error('blog_image')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Descriptons</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="blog_des" />
              </div>
              @error('blog_des')
              <span style="color: red">{{ $message }}</span>
            @enderror
              <div class="form-text">You can use letters, numbers & periods</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message" >Content</label>
            <div class="col-sm-10">
              <textarea name="blog_content" id="blog_content" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" ></textarea>
              @error('blog_content')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Options</label>
            <div class="col-sm-10">
                <select class="form-select" id="inputGroupSelect01" name="blog_status">
                    <option selected value="0">Kích hoạt</option>
                    <option value="1">Vô hiệu hóa</option>
                  </select>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Thêm bài viết</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
