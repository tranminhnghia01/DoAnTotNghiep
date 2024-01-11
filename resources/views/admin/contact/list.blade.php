@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Liên hệ</h5>

            <!-- Table with stripped rows -->
            <div class="card card-body">
                <div class="table-responsive">
                  <table class="table search-table v-middle">
                    <thead class="header-item">
                      <tr><th>
                        <div class="n-chk align-self-center text-center">
                          <div class="form-check">
                            <input type="checkbox" class="form-check-input secondary" id="contact-check-all">
                            <label class="form-check-label" for="contact-check-all"></label>
                            <span class="new-control-indicator"></span>
                          </div>
                        </div>
                      </th>
                      <th>Họ tên</th>
                      <th>Email</th>
                      <th>Vấn đề</th>
                      <th>Nội dung</th>
                      <th>Trạng thái</th>
                      <th>Tùy chọn</th>
                    </tr></thead>
                    <tbody>
                      <!-- row -->
                      @foreach ($about as $key=>$value )
                      <tr class="search-items">
                        <td>
                          <div class="n-chk align-self-center text-center">
                            <div class="form-check">
                              <input type="checkbox" class="form-check-input contact-chkbox primary" id="checkbox1">
                              <label class="form-check-label" for="checkbox1"></label>
                            </div>
                          </div>
                        </td>
                        <td>
                          <div class="d-flex align-items-center">
                            <div class="ms-3">
                              <div class="user-meta-info">
                                <h6 class="user-name mb-0 font-weight-medium" data-name="Emma Adams">
                                  {{ $value->contact_name }}
                                </h6>
                                {{-- <small class="user-work text-muted" data-occupation="Web Developer">Web Developer</small> --}}
                              </div>
                            </div>
                          </div>
                        </td>
                        <td>
                          <span class="usr-email-addr" data-email="adams@mail.com">{{ $value->contact_email }}</span>
                        </td>
                        <td>
                          <span class="usr-location" data-location="Boston, USA">{{ $value->contact_subject }}</span>
                        </td>
                        <td>
                          <span class="usr-ph-no" data-phone="+1 (070) 123-4567">{{ $value->contact_content }}</span>
                        </td>
                        <td>
                            @if ($value->contact_status == 0)
                            <span class="btn btn-success">Đã phản hồi</span>

                            @else
                            <span class="btn btn-danger">phản hồi</span>

                            @endif
                          </td>
                        <td>
                          <div class="action-btn">
                            <a class="text-info edit btn-contact-reply" data-contact_id="{{ $value->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye feather-sm fill-white"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a>
                            <a class="text-dark delete ms-2 destroy-contact"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 feather-sm fill-white"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></a>
                          </div>
                        </td>
                      </tr>
                      @endforeach

                      <!-- /.row -->
                    </tbody>
                  </table>
                </div>
              </div>

            <!-- End Table with stripped rows -->

          </div>
        </div>
      </div>
      <div id="modal-about-reply"></div>
    </div>
  </section>

@endsection
