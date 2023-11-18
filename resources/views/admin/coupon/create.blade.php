<form action="{{ route('admin.coupon.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Tên</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="basic-default-name" name="coupon_name"/>
      @error('coupon_name')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Mã</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="basic-default-name" name="coupon_code"/>
      @error('coupon_code')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-message">Phương thức giảm</label>
    <div class="col-sm-2">
        <select class="form-select" id="inputGroupSelect01" name="coupon_method">
            <option selected value="0">%</option>
            <option value="1">Tiền mặt</option>
          </select>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Số tiền/%</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="basic-default-name" name="coupon_number" />
      @error('coupon_number')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Bắt đầu giảm giá</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="basic-default-name" name="coupon_time_start" />
      @error('couponcoupon_time_start')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Kết thúc</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="basic-default-name" name="coupon_time_end" />
      @error('couponcoupon_time_end')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-email">Mô tả</label>
    <div class="col-sm-10">
      <div class="input-group input-group-merge">
        <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="coupon_des" />
      </div>
      @error('coupon_des')
      <span style="color: red">{{ $message }}</span>
    @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-message"></label>
    <div class="col-sm-10">
        <select class="form-select" id="inputGroupSelect01" name="coupon_status">
            <option selected value="0">Kích hoạt</option>
            <option value="1">Vô hiệu hóa</option>
          </select>
    </div>
  </div>

  <div class="row justify-content-end">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Xác nhận</button>
    </div>
  </div>
</form>

