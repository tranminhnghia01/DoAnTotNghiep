   <!-- Profile Edit Form -->
   <form enctype="multipart/form-data" method="POST" action="{{ route('admin.housekeeper.update',$housekeeper->housekeeper_id) }}" >
    @method('PUT')
    @csrf
  <div class="row mb-3">
    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ảnh nền</label>
    <div class="col-md-8 col-lg-9">
        @if (empty($housekeeper->image))
                <img src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="Profile">
            @else
                <img src="{{ asset('uploads/users/'.$housekeeper->image) }}" alt="Profile">
            @endif
      <div class="pt-2">
        <label for="uploadImage"  class="btn btn-primary btn-sm" title="Upload new profile image" style="color: #fff">
            <i class="bi bi-upload"><input type="file" name="image" id="uploadImage"  accept="image/png, image/jpeg" hidden /></i></label>
        <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
      </div>
    </div>
  </div>

  <div class="row mb-3">
    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Họ tên</label>
    <div class="col-md-8 col-lg-9">
      <input name="name" type="text" class="form-control" id="name" value="{{ $housekeeper->name }}">
    </div>
  </div>

  <div class="row mb-3">
    <label for="about" class="col-md-4 col-lg-3 col-form-label">Mô tả</label>
    <div class="col-md-8 col-lg-9">
      <textarea name="des" class="form-control" id="about" style="height: 100px">{{ $housekeeper->des }}</textarea>
    </div>
  </div>



  <div class="row mb-3">
    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Vị trí</label>
    <div class="col-md-8 col-lg-9">
      <input name="role_name" type="text" class="form-control" id="Job" readonly
        @if ($housekeeper->role_name)
        value="{{ $housekeeper->role_name }}"
        @else
        value="Người giúp việc"
        @endif
      >
    </div>
  </div>

  <div class="row mb-3">
    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Địa chỉ</label>
      <div class="col-md-3">
        <select id="city"  class="form-select  choose city" >
          <option >Thành phố...</option>
          @foreach ($city as $item)
                <option value="{{ $item->city_id }}">{{ $item->city_name }}</option>
            @endforeach
        </select>
      </div>
      <div class="col-md-3">
        <select id="province" class="form-select  choose province">
        </select>
      </div>
      <div class="col-md-3">
        <select id="ward"  class="form-select ward">
            <option value=""></option>
        </select>
      </div>
  </div>

  <div class="row mb-3">
    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Chi tiết</label>
    <div class="col-md-8 col-lg-9">
      <input name="address" type="text" class="form-control" id="address" value="{{ $housekeeper->address }}">
    </div>
  </div>

  <div class="row mb-3">
    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Số điện thoại</label>
    <div class="col-md-8 col-lg-9">
      <input name="phone" type="text" class="form-control" id="phone" value="{{ $housekeeper->phone }}">
    </div>
  </div>
  <div class="row mb-3">
    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Tuổi</label>
    <div class="col-md-8 col-lg-9">
      <input name="age" type="number" class="form-control" id="phone" value="{{ $housekeeper->age }}">
    </div>
  </div>



  </fieldset>
  <div class="row mb-3">
    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Giới tính</label>
    <div class="col-md-8 col-lg-9">
            <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="1" @if ($housekeeper->gender == 1)
                checked
            @endif>
            <label class="form-check-label" for="gridRadios1">
              Nam
            </label>

            <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="0" @if ($housekeeper->gender == 0)
            checked
        @endif>
            <label class="form-check-label" for="gridRadios2">
              Nữ
            </label>
    </div>
  </div>

  <div class="row mb-3">
    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
    <div class="col-md-8 col-lg-9">
      <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label for="status" class="col-md-4 col-lg-3 col-form-label">Trạng thái</label>
    <div class="col-md-8">
        <select    class="form-select"  name="status">
        <option selected value="0">Duyệt</option>
        <option value="1">Bỏ duyệt</option>
        </select>
    </div>
  </div>

  <div class="row mb-3">
    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Ảnh CCCD</label>
    <div class="col-md-8 col-lg-9">
      <input name="files[]" type="file" class="form-control" multiple>
    </div>
  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
  </div>
</form><!-- End Profile Edit Form -->
