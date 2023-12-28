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
              <h5 class="card-title">Danh sách đánh giá sao bình luận</h5>
              <!-- Default Accordion -->
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
                              <th scope="col">Trả lời</th>
                          </tr>
                          </tr>
                        </thead>
                        <tbody>
                @foreach ($housekeeper as $key => $val)
                          @foreach ($comment as $keyCM => $valueCM)
                          @if ($valueCM->housekeeper_id == $val->housekeeper_id)
                              <tr>
                                  <td>{{ $key+1 }}</td>
                                  <td><img src="{{ asset('uploads/users/'.$valueCM->image) }}" alt="" style="width: 100px;height:100px"></td>
                                  <td> {{ $valueCM->name }} </td>
                                  <td> {{ $valueCM->rate }} </td>
                                  <td> <div  style="width: 300px">{{ $valueCM->comment }}</div></td>

                                        <td>
                                  <form action="{{route('admin.comment.reply',$valueCM->comment_id)}}" method="post" >
                                    @csrf
                                    <textarea type="text" name="reply" style="width: 100%" placeholder="">{{ $valueCM->reply }}</textarea>
                                    <button type="submit" class="btn btn-primary"><i class="bx bx-edit-alt me-1"></i>Phản hồi bình luận</button>
                                </form>
                            </td>
                              </tr>
                          @endif
                              @endforeach
                @endforeach

                        </tbody>
                      </table>
                </div>


            </div>
          </div>


    </div>
  </section>

@endsection
