@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Products</h4>
        <div class="card">
            <h5 class="card-header">Table Basic</h5>
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
                    <th>Name</th>
                    <th>image</th>
                    <th>qty</th>
                    <th>price</th>
                    <th>status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($products as $item => $value)
                    @php
                            $image_product = json_decode($value->product_image);
                        @endphp
                    <tr>
                        <td>{{  $value->id }}</td>
                        <td>{{ $value->product_name }}</td>
                        <td>
                            @foreach ($image_product as $show_img)
                            <img class="profile-image col-sm-3" style=" height: 100px; float: left; padding:10px" src="{{ asset('uploads/products/'.$show_img) }}" title="{{ $show_img }}">
                            @endforeach
                        </td>
                        <td>{{ $value->product_qty }}</td>
                        <td>{{ $value->product_price }}</td>
                        @if ($value->product_status == 0)
                            <td><span class="badge bg-label-success me-1">Active</span></td>
                        @else
                        <td><span class="badge bg-label-danger me-1">InActive</span></td>
                        @endif

                        <td>
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('admin.product.edit',$value->id) }}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a>

                                <form action="{{ route('admin.product.destroy',$value->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Delete</button>
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
                        {{-- {{ $products->links('pagination::bootstrap-4') }} --}}

                    </ul>
                  </nav>
                </div>
            </div>
            <a href="{{ route('admin.product.create') }}" type="button" class="btn btn-success m-2">Add Product</a>
            </div>
        </div>

    </div>
@endsection
