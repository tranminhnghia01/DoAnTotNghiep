@extends('admin.layouts.app')
@section('container')
<section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Liên hệ</h5>

            <!-- Table with stripped rows -->

      <div class="card-body ">
        <form action="{{ route('admin.contact.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Email</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="basic-default-name" name="info_email"  value="{{ $contact->info_email }}" />
              @error('info_email')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Địa điểm</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="info_address" value="{{ $contact->info_address }}" />
              </div>
              @error('info_address')
              <span style="color: red">{{ $message }}</span>
            @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Số điện thoại</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="info_phone"  value="{{ $contact->info_phone }}"  />
              </div>
              @error('info_phone')
              <span style="color: red">{{ $message }}</span>
            @enderror
            </div>
          </div>

          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message" >Map</label>
            <div class="col-sm-10">
              <textarea rows="8" cols="10" name="info_map"  class="form-control" >
                {{ $contact->info_map }}
              </textarea>
              @error('info_map')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-default-message" >Fanpage</label>
            <div class="col-sm-10">
              <textarea rows="8" cols="10" name="info_fanpage"  class="form-control" >
                {{ $contact->info_fanpage }}
              </textarea>
              @error('info_fanpage')
                <span style="color: red">{{ $message }}</span>
              @enderror
            </div>
          </div>




          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Cập nhật thông tin liên hệ</button>
            </div>
          </div>
        </form>
      </div>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

@endsection
