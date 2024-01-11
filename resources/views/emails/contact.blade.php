<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>


    “Khách hàng:{{ $contact->contact_name }} thân mến: <br>

    Chúng tôi đã nhận được câu hỏi của quý khách về vấn đề: {{ $contact->contact_subject }} <br>

Cảm ơn quý khách đã hỏi về: {{ $contact->contact_content }}. <br>

Sau đây chúng tôi xin trả lời câu hỏi của quý khách :
{!! $contact->contact_reply !!}

Để được tư vấn kỹ hơn chúng tôi muốn nhận được thêm những thông tin về nhu cầu sử dụng của quý khách: <br>

- quý khách sử dụng phần mềm ở những loại doanh nghiệp nào? quý khách có tự làm chủ, là quản lý hoặc là chủ một doanh nghiệp không? <br>

- quý khách sẽ sử dụng phần mềm trên một thiết bị di động hay máy tính? Và máy tính của quý khách là máy PC hay máy tính xách tay? <br>

- Mục đích sử dụng chính của quý khách là thu hút thật nhiều khách hàng, quản lý nhân viên, quản lý kho,… . <br>

Một lần nữa, cảm ơn quý khách đã quan tâm.  <br>
Tôi hy vọng quý khách sẽ tìm thấy phần mềm phù hợp nhất cho nhu cầu kinh doanh của mình. <br>
 <br>
Trân trọng," <br>

</body>
</html>
