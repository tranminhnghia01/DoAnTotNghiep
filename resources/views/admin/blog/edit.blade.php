@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Cập nhật bài viết</h5>
            <!-- Table with stripped rows -->
      <div class="card-body ">
        <form action="{{ route('admin.blog.update',$blog->blog_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Tiêu đề</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="blog_title" placeholder="blog title" value="{{ $blog->blog_title }}" />
              @error('blog_title')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Ảnh</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="basic-default-company" placeholder="ACME Inc." name="blog_image" />
              @error('blog_imagr')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Mô tả</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="blog_des" value="{{ $blog->blog_des }}" />
              </div>
              @error('blog_des')
              <span style="color: red">{{ $message }}</span>
            @enderror
              <div class="form-text">You can use letters, numbers & periods</div>
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message" >Nội dung</label>
            <div class="col-sm-10">
              <textarea name="blog_content" id="blog_content" class="form-control" placeholder="Hi, Do you have a moment to talk Joe?"
                aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" > {{ $blog->blog_content }}</textarea>
              @error('blog_content')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message">Trạng thái</label>
            <div class="col-sm-10">
                <select class="form-select" id="inputGroupSelect01" name="blog_status">
                    @if ($blog->blog_status == 0)
                        <option selected value="0">Kích hoạt</option>
                        <option value="1">Vô hiệu hóa</option>
                    @else
                        <option value="0">Kích hoạt</option>
                        <option selected value="1">Vô hiệu hóa</option>
                    @endif
                  </select>
            </div>
          </div>

          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
