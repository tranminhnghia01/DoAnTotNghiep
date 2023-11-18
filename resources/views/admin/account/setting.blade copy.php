   <!-- Profile Edit Form -->
   <form enctype="multipart/form-data" method="POST" action="{{ route('admin.account.update') }}" >
    @csrf
  <div class="row mb-3">
    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ảnh nền</label>
    <div class="col-md-8 col-lg-9">
      <img src="{{asset('uploads/users/'.$user->image)}}" alt="Profile">
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
      <input name="fullName" type="text" class="form-control" id="name" value="{{ $user->name }}">
    </div>
  </div>

  <div class="row mb-3">
    <label for="about" class="col-md-4 col-lg-3 col-form-label">Mô tả</label>
    <div class="col-md-8 col-lg-9">
      <textarea name="des" class="form-control" id="about" style="height: 100px">{{ $user->des }}</textarea>
    </div>
  </div>

  <div class="row mb-3">
    <label for="company" class="col-md-4 col-lg-3 col-form-label">Công ty</label>
    <div class="col-md-8 col-lg-9">
      <input name="company" type="text" class="form-control" id="company" value="{{ $user->company }}" readonly>
    </div>
  </div>

  <div class="row mb-3">
    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Vị trí</label>
    <div class="col-md-8 col-lg-9">
      <input name="role_name" type="text" class="form-control" id="Job" value="{{ $role->role_name }}">
    </div>
  </div>

  <div class="row mb-3">
    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Địa chỉ</label>
    {{-- <div class="col-md-8 col-lg-9">
      <select name="" id="">
        <option value="">1</option>
        <option value="">1</option>
        <option value="">1</option>
        <option value="">1</option>
      </select>
    </div> --}}
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
      <input name="address" type="text" class="form-control" id="address" value="{{ $user->address }}">
    </div>
  </div>

  <div class="row mb-3">
    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Số điện thoại</label>
    <div class="col-md-8 col-lg-9">
      <input name="phone" type="text" class="form-control" id="phone" value="{{ $user->phone }}">
    </div>
  </div>
  <div class="row mb-3">
    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Tuổi</label>
    <div class="col-md-8 col-lg-9">
      <input name="age" type="number" class="form-control" id="phone" value="{{ $user->age }}">
    </div>
  </div>



  </fieldset>
  <div class="row mb-3">
    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Giới tính</label>
    <div class="col-md-8 col-lg-9">
            <input class="form-check-input" type="radio" name="gender" id="gridRadios1" value="0" checked>
            <label class="form-check-label" for="gridRadios1">
              Nam
            </label>

            <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="1">
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
    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter hồ sơ</label>
    <div class="col-md-8 col-lg-9">
      <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
    </div>
  </div>

  <div class="row mb-3">
    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook hồ sơ</label>
    <div class="col-md-8 col-lg-9">
      <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
    </div>
  </div>

  <div class="row mb-3">
    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram hồ sơ</label>
    <div class="col-md-8 col-lg-9">
      <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
    </div>
  </div>

  <div class="row mb-3">
    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin hồ sơ</label>
    <div class="col-md-8 col-lg-9">
      <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
    </div>
  </div>

  <div class="text-center">
    <button type="submit" class="btn btn-primary">Lưu thông tin</button>
  </div>
</form><!-- End Profile Edit Form -->
