@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div id="notify-comment"></div>

        <div class="card">
            <div class="card-body">

              <h5 class="card-title">Danh sách đánh giá sao bình luận</h5>
              <!-- Default Accordion -->
                <div class="accordion-body">
                    <table class="table datatable">
                        <thead>
                          <tr>
                            <tr>
                              <th scope="col">#</th>
                              <th scope="col">#</th>
                              <th scope="col">Hình ảnh</th>
                              <th scope="col">tên</th>
                              <th scope="col">Số sao</th>
                              <th scope="col">Bình luận khách hàng</th>
                              <th scope="col">Phản hồi bình luận</th>
                              <th scope="col"></th>

                          </tr>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($comment as $key => $value)
                              <tr>
                                <td>
                                    @if ($value->status == 0)
                                    <button type="button" class="change-status-comment btn btn-primary" data-comment_id="{{ $value->comment_id }}" value="1"><i class="bx bx-edit-alt me-1" style="width: 150px;">Đã duyệt</i></button>

                                    @else
                                    <button type="button" class="change-status-comment btn btn-danger" data-comment_id="{{ $value->comment_id }}" value="0"><i class="bx bx-edit-alt me-1" style="width: 150px;">Duyệt</i></button>

                                    @endif
                                </td>
                                  <td>{{ $key+1 }}</td>
                                  <td><img src="{{ asset('uploads/users/'.$value->image) }}" alt="" style="width: 100px;height:100px"></td>
                                  <td> {{ $value->name }} </td>
                                  <td> {{ $value->rate }} </td>
                                  <td> <div  style="width: 300px">{{ $value->comment }}</div></td>

                                   <td>
                                        <form action="{{route('admin.comment.reply',$value->comment_id)}}" method="post" >
                                            @csrf
                                            <textarea type="text" name="reply" style="width: 100%" placeholder="">{{ $value->reply }}</textarea>
                                            <button type="submit" class="btn btn-default"><i class="bx bx-edit-alt me-1"></i>Phản hồi bình luận</button>
                                        </form>
                                 </td>
                                 <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('admin.comment.thanks',$value->comment_id) }}"
                                            ><i class="bx bx-edit-alt me-1"></i> Gửi lời cảm ơn</a>
                                        </div>
                                 </td>

                              </tr>
                              @endforeach

                        </tbody>
                      </table>
                </div>


            </div>
          </div>


    </div>
  </section>

@endsection
