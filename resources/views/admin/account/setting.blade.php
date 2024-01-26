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
        <a  class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
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
