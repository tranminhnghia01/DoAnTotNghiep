@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                @error('reply')
                <div class="alert alert-warning"  role="alert">
                    {{ $message }}
                </div>
              @enderror
              <h5 class="card-title">Danh sách bài viết</h5>
              <!-- Default Accordion -->
                <div class="accordion-body">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu đề</th>
                            <th>Ảnh</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($blog as $item => $value)
                            <tr>
                                <td>{{ $value->blog_id }}</td>
                                <td><img src=" {{ asset('uploads/blogs/'.$value->blog_image)}} " alt="" style="width: 80px;height: 80px;"></td>
                                <td>{{ $value->blog_title }}</td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.blog.edit',$value->blog_id) }}"
                                            ><i class="bx bx-edit-alt me-1"></i> Sửa</a>

                                            <form action="{{ route('admin.blog.destroy',$value->blog_id) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Xóa</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>


            </div>
          </div>
          <a href="{{ route('admin.blog.create') }}" type="button" class="btn btn-primary m-2">Thêm mới bài viết</a>


    </div>
  </section>

@endsection
