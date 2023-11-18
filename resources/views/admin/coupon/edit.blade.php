
<form action="{{ route('admin.coupon.update',$coupon->coupon_id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Tên</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="basic-default-name" name="coupon_name" value="{{ $coupon->coupon_name }}"/>
      @error('coupon_name')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Mã</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="basic-default-name" name="coupon_code" value="{{ $coupon->coupon_code }}"/>
      @error('coupon_code')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-message">Phướng thức giảm</label>
    <div class="col-sm-2">
        <select class="form-select" id="inputGroupSelect01" name="coupon_method">
            @if ($coupon->coupon_method == 0)
                <option selected value="0">%</option>
                <option value="1">Tiền mặt</option>
            @else
                <option value="0">%</option>
                <option selected value="1">Tiền mặt</option>
            @endif
          </select>
    </div>
  </div>
  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Số tiền / %</label>
    <div class="col-sm-2">
      <input type="text" class="form-control" id="basic-default-name" name="coupon_number" value="{{ $coupon->coupon_number }}"/>
      @error('coupon_number')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Bắt đầu giảm giá</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="basic-default-name" name="coupon_time_start" value="{{ $coupon->coupon_time_start }}"/>
      @error('coupon_time_start')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-name">Kết thúc</label>
    <div class="col-sm-10">
      <input type="date" class="form-control" id="basic-default-name" name="coupon_time_end" value="{{ $coupon->coupon_time_end }}"/>
      @error('coupon_time_end')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-email">Mô tả</label>
    <div class="col-sm-10">
      <div class="input-group input-group-merge">
        <input type="text" id="basic-default-email" class="form-control" aria-describedby="basic-default-email2" name="coupon_des"  value="{{ $coupon->coupon_des }}" />
      </div>
      @error('coupon_des')
      <span style="color: red">{{ $message }}</span>
    @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-message" >Chi tiết</label>
    <div class="col-sm-10">
      <textarea name="coupon_content" id="coupon_content" class="form-control"
        aria-label="Hi, Do you have a moment to talk Joe?" aria-describedby="basic-icon-default-message2" >{{ $coupon->coupon_content }}</textarea>
      @error('coupon_content')
        <span style="color: red">{{ $message }}</span>
      @enderror
    </div>
  </div>

  <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-message"></label>
    <div class="col-sm-10">
        <select class="form-select" id="inputGroupSelect01" name="coupon_status">
            @if ($coupon->coupon_status == 0)
                <option selected value="0">Kích hoạt</option>
                <option value="1">Vô hiệu hóa</option>
            @else
                <option value="0">Kích hoạt</option>
                <option selected value="1">Vô hiệu hóa</option>
            @endif
          </select>
    </div>
  </div>

  <div class="row justify-content-end">
    <div class="col-sm-10">
      <button type="submit" class="btn btn-primary">Cập nhật</button>
    </div>
  </div>
</form>
