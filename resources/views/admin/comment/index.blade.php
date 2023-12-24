@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
            <div class="card-body">
              <h5 class="card-title">Danh sách đánh giá sao bình luận</h5>

              <!-- Default Accordion -->
              <div class="accordion" id="accordionExample">
                @foreach ($housekeeper as $key => $val)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{$key}}">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$key}}" aria-expanded="false" aria-controls="collapse{{$key}}">
                        {{ $val->name }}
                      </button>
                    </h2>
                    <div id="collapse{{$key}}" class="accordion-collapse collapse" aria-labelledby="heading{{$key}}" data-bs-parent="#accordionExample" style="">
                      <div class="accordion-body">
                        <table class="table datatable">
                            <thead>
                              <tr>
                                <tr>
                                  <th scope="col">#</th>
                                  <th scope="col">Hình ảnh</th>
                                  <th scope="col">tên</th>
                                  <th scope="col">Số sao</th>
                                  <th scope="col">Bình luận</th>
                                  <th></th>
                              </tr>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($comment as $keyCM => $valueCM)
                              @if ($valueCM->housekeeper_id == $val->housekeeper_id)
                                  <tr>
                                      <td>{{ $key+1 }}</td>
                                      <td><img src="{{ asset('uploads/users/'.$valueCM->image) }}" alt="" style="width: 100px;height:100px"></td>
                                      <td> {{ $valueCM->name }} </td>
                                      <td> {{ $valueCM->rate }} </td>
                                      <td>{{ $valueCM->comment }}</td>
                                      <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                            <a class="dropdown-item" href=""
                                                ><i class="bx bx-edit-alt me-1"></i> Phản hồi</a
                                            >

                                            <form action="" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="dropdown-item"><i class="bx bx-trash me-1"></i>Xóa</button>
                                            </form>
                                            </div>
                                        </div>
                                    </td>
                                  </tr>
                              @endif

                                  @endforeach
                            </tbody>
                          </table>
                    </div>
                  </div>
                @endforeach

              </div><!-- End Default Accordion Example -->

            </div>
          </div>


    </div>
  </section>

@endsection
