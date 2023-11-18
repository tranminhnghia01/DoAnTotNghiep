<form action="{{ route('admin.update-password') }}" method="POST">
    @csrf
    <div class="row mb-3">
      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Mật khẩu cũ</label>
      <div class="col-md-8 col-lg-9">
        <input name="old_password" type="password" class="form-control" id="currentPassword">
      </div>
    </div>

    <div class="row mb-3">
      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Mật khẩu mới</label>
      <div class="col-md-8 col-lg-9">
        <input name="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" id="newPassword">
      </div>
    </div>

    <div class="row mb-3">
      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Nhập lại mật khẩu mới</label>
      <div class="col-md-8 col-lg-9">
        <input name="new_password_confirmation" type="password" class="form-control" id="renewPassword">
      </div>
    </div>

    <div class="text-center">
      <button type="submit" class="btn btn-primary">Thay đổi mật khẩu</button>
    </div>
  </form>
