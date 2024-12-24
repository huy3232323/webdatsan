<?php

require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "Mật khẩu không khớp!";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT * FROM tbl_taikhoan WHERE username = :username");
    $stmt->execute(['username' => $username]);
    if ($stmt->rowCount() > 0) {
        echo "Tên người dùng đã tồn tại!";
        exit;
    }

    $user_id = uniqid();
    $role_id = 3; 
    $status = 1; 

    $sql = "INSERT INTO tbl_taikhoan (username, password, idkh, idrole, trangthai, createdDate) 
            VALUES (:username, :password, :idkh, :idrole, :trangthai, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'username' => $username,
        'password' => $hashed_password,
        'idkh' => $user_id,
        'idrole' => $role_id,
        'trangthai' => $status
    ]);

    $sql_customer = "INSERT INTO tbl_customer (id, tenkhachhang, email, sodt, createdDate) 
                     VALUES (:id, :fullname, :email, :phone, NOW())";
    $stmt_customer = $conn->prepare($sql_customer);
    $stmt_customer->execute([
        'id' => $user_id,
        'fullname' => $fullname,
        'email' => $email,
        'phone' => $phone
    ]);

    echo "Đăng ký thành công! <a href='login.php' class='button-link'>Đăng nhập</a>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
/* Reset chung */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background: url('image/3.jpg') no-repeat center center fixed; /* Đường dẫn đến ảnh nền */
    background-size: cover; /* Ảnh phủ toàn bộ màn hình */
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    color: #333;
}

/* Container của form */
.login-page {
    background: #fff;
    width: 400px;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15); /* Hiệu ứng đổ bóng */
    text-align: center;
}

/* Tiêu đề */
.login-page h2 {
    font-size: 28px;
    font-weight: bold;
    margin-bottom: 1.5rem;
    color: #6a11cb; /* Màu chữ chính */
}

/* Input */
.login-page input[type="text"],
.login-page input[type="email"],
.login-page input[type="tel"],
.login-page input[type="password"] {
    width: 100%;
    padding: 0.75rem;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f7f7f7;
    font-size: 16px;
    transition: border 0.3s, box-shadow 0.3s;
}

/* Hiệu ứng khi focus */
.login-page input:focus {
    border: 1px solid #6a11cb;
    box-shadow: 0 0 6px rgba(106, 17, 203, 0.5);
    outline: none;
}

/* Nút bấm */
.login-page button {
    width: 100%;
    padding: 0.75rem;
    margin-top: 1rem;
    background: linear-gradient(135deg, #6a11cb, #2575fc); /* Nền gradient */
    border: none;
    border-radius: 8px;
    color: #fff;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s ease;
}

/* Hiệu ứng hover */
.login-page button:hover {
    background: linear-gradient(135deg, #5b0fc2, #2069e6);
    transform: translateY(-2px);
}

/* Tin nhắn và liên kết */
.login-page .message {
    margin-top: 1rem;
    font-size: 14px;
    color: #555;
}

.login-page .message a {
    color: #6a11cb;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

.login-page .message a:hover {
    color: #2575fc;
}

/* Tin nhắn lỗi */
.login-page .error-message {
    margin-top: 1rem;
    color: red;
    font-size: 14px;
}
a.button-link {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4CAF50; /* Màu nền */
    color: white; /* Màu chữ */
    text-decoration: none; /* Bỏ gạch chân */
    border-radius: 5px; /* Bo góc */
    font-size: 16px; /* Kích thước chữ */
    transition: background-color 0.3s; /* Hiệu ứng khi hover */
  }

  a.button-link:hover {
    background-color: #45a049; /* Màu khi hover */
  }
    
</style>

</head>

<body>
    <div class="login-page">
    <h2>Đăng ký</h2>
        <div class="form">
            <form class="login-form"  method="post">
                <input type="text" name="username" placeholder="Tên đăng nhập" required />
                <input type="text" name="fullname" placeholder="Họ và tên" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="tel" name="phone" placeholder="Số điện thoại" required />
                <input type="password" name="password" placeholder="Mật khẩu" required />
                <input type="password" name="confirm_password" placeholder="Nhập lại mật khẩu" required />
                <button type="submit">Đăng ký</button>
                <p class="message">Đã có tài khoản? <a href="login.php">Đăng nhập</a></p>
            </form>
        </div>
    </div>
</body>

</html>