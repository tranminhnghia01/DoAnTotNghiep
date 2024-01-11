<form action="{{ route('home.Account.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row mb-3">
        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Ảnh nền</label>
        <div class="col-md-8 col-lg-9">
            @if (empty($shipping->shipping_image))
                    <img src="{{ asset('admin/assets/img/apple-touch-icon.png') }}" alt="Profile">
                @else
                    <img src="{{ asset('uploads/users/'.$shipping->shipping_image) }}" alt="Profile" style="width: 150px;height: 150px;">

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
        <input name="name" type="text" class="form-control" id="name" value="{{ $shipping->shipping_name }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Job" class="col-md-4 col-lg-3 col-form-label">Vị trí</label>
        <div class="col-md-8 col-lg-9">
        <input name="role_name" type="text" class="form-control" id="Job" readonly
            value="Người sủ dụng hệ thống">
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
        <input name="address" type="text" class="form-control" id="address" value="{{ $shipping->shipping_address }}">
        </div>
    </div>

    <div class="row mb-3">
        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Số điện thoại</label>
        <div class="col-md-8 col-lg-9">
        <input name="phone" type="text" class="form-control" id="phone" value="{{ $shipping->shipping_phone }}">
        </div>
    </div>

    </fieldset>

    <div class="row mb-3">
        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
        <div class="col-md-8 col-lg-9">
        <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Lưu thông tin</button>
    </div>
</form>
