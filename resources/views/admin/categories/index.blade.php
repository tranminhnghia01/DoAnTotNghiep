@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms /</span> Danh mục</h4>
        <div class="card">
            <h5 class="card-header">Danh mục</h5>
              @if (session('msg'))
            <div class="alert alert-{{session('style')}}">
            {{ session('msg') }}
            </div>
         @endif
            <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Level</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($list_Category as $item => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->category_name }}</td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class="avatar avatar-xs pull-up">
                                    <img src="{{ asset('uploads/categories/'.$value->category_image) }}" alt="Avatar" class="rounded-circle" />
                                </li>
                            </ul>
                        </td>
                        <td>
                            @foreach ($list_Category as $itemlevel=> $val_level )
                                @if ( $val_level->id == $value->category_level)
                                    <span class="badge bg-label-success me-1"> {{ $val_level->category_name }} </span>
                                @endif
                            @endforeach
                        </td>

                        @if ($value->category_status == 0)
                            <td><span class="badge bg-label-success me-1">Kích hoạt</span></td>
                        @else
                            <td><span class="badge bg-label-danger me-1">Vô hiệu hóa</span></td>
                        @endif

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('admin.category.edit',$value->id) }}"
                                    ><i class="bx bx-edit-alt me-1"></i> Sửa</a
                                >

                                <form action="{{ route('admin.category.destroy',$value->id) }}" method="post">
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
            <div class="col-lg-12">
                <div class="demo-inline-spacing">
                  <nav aria-label="Page navigation">
                    <ul class="pagination  justify-content-end">
                    </ul>
                  </nav>
                </div>
            </div>
            <a href="{{ route('admin.category.create') }}" type="button" class="btn btn-primary m-2">Thêm danh mục dịch vụ</a>
            </div>
        </div>

    </div>
@endsection
