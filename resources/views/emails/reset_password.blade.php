<!DOCTYPE html>
<html>
<head>
    <title>Đặt lại mật khẩu</title>
    <style>
        /* CSS nội tuyến mạnh mẽ cho nút */

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #fff !important;
            text-align: center;
            vertical-align: middle;
            user-select: none;
            background-color: #343a40;
            border: 1px solid #343a40;
            padding: 0.375rem 0.75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: 0.25rem;
            text-decoration: none !important;
            cursor: pointer;
        }
        .btn-container {
            text-align: center; /* Căn giữa nội dung bên trong thẻ div */
            margin: 20px 0; /* Thêm khoảng cách trên dưới cho nút */
            width: 500px;
        }
    </style>
</head>
<body>
    <h1>Đặt lại mật khẩu của bạn</h1>
    <p>Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu đặt lại mật khẩu cho tài khoản của bạn.</p>
    <p>Vui lòng nhấp vào nút dưới đây để đặt lại mật khẩu của bạn:</p>
    <div class="btn-container">
        <a href="{{ $resetUrl }}" class="btn">Thay đổi mật khẩu</a>
    </div>
    <p>Liên kết đặt lại mật khẩu sẽ hết hạn trong 60 phút nữa.</p>
    <p>Nếu bạn không yêu cầu đặt lại mật khẩu, không cần thực hiện hành động nào.</p>
    <p>Trân trọng,</p>
</body>
</html>
