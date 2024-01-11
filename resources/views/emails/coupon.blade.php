<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
        }

        .coupon {
            border: 5px dotted #bbb;
            width: 80%;
            border-radius: 15px;
            margin: 0 auto;
            max-width: 600px;
        }

        .content-coupon{
            padding: 2px 16px;
            background-color: #f1f1f1;
        }

        .promo{
            background: #ccc;
            padding: 3px;
        }

        .exprire {
            color:red;
        }

        p.code {
            text-align: center;
            font-size: 20px;
        }
        p.exprire{
            text-align: center;
        }
        h2.notes{
            text-align: center;
            font-size: large;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="coupon">
        <div class="content-coupon">
            <h3>Mã khuyến mãi từ shop: <a href="{{ route('home.index') }}">Moon.com</a></h3>
        </div>
        <div class="content-coupon">
            <h2 class="notes">
                <b><i>{{ $coupon->coupon_name }}</i></b>
                <p>Khách hàng đặt lịch tại website giúp việc nhà theo giờ: <a href="{{ route('home.index') }}" target="_black" style="color: red">Moon.com</a>
                nếu đã có tài khoản xin vui lòng <a href=" {{ route('home.login') }} " target="_black" style="color: red">đăng nhập</a>
             vào tài khoản để đặt lịch và sử dụng mã giảm giá bên dưới để được giảm giá ,xin cảm ơn quý khách. Chúc quý khách thật nhiều sức khỏe và bình an trong cuộc sống</p>
            </h2>
        </div>
        <div class="content-coupon">
            <p class="code">Vui lòng chọn code sau: <span class="promo">{{ $coupon->coupon_code }}</span></p>
            <p class="expire"> Ngày hết hạn: {{ date('d-m-y',strtotime($coupon->coupon_time_end)) }} </p>
        </div>
    </div>

</body>
</html>
