<?php
session_start();
require_once "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tbl_taikhoan WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id_taikhoan'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['idrole'];

        if ($user['idrole'] == 1) {
            header("Location: admin/index.php");
        } elseif ($user['idrole'] == 3) {
            header("Location: index.php");
        } else {
            header("Location: 403.php");
            $error = "Không có quyền vào";
        }
        exit();
    } else {
        $error = "Sai!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General Reset */
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
        }

        /* Login Form Container */
        .form-container {
            background: #fff;
            width: 400px;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.15);
            text-align: center;
        }

        /* Title Styling */
        .form-container h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #6a11cb;
        }

        /* Input Fields */
        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f7f7f7;
            font-size: 16px;
            transition: border 0.3s, box-shadow 0.3s;
        }

        /* Focused Input Fields */
        .form-container input[type="text"]:focus,
        .form-container input[type="password"]:focus {
            border: 1px solid #6a11cb;
            box-shadow: 0 0 6px rgba(106, 17, 203, 0.5);
            outline: none;
        }

        /* Login Button */
        .form-container button {
            width: 100%;
            padding: 0.75rem;
            margin-top: 1rem;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            border: none;
            border-radius: 8px;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s ease;
        }

        /* Hover Effect for Button */
        .form-container button:hover {
            background: linear-gradient(135deg, #5b0fc2, #2069e6);
            transform: translateY(-2px);
        }

        /* Error Message */
        .form-container .error-message {
            margin-top: 1rem;
            color: red;
            font-size: 14px;
        }

        /* Message Text */
        .form-container .message {
            margin-top: 1rem;
            font-size: 14px;
            color: #555;
        }

        /* Link Styling */
        .form-container .message a {
            color: #6a11cb;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s;
        }

        .form-container .message a:hover {
            color: #2575fc;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2>Đăng nhập</h2>
        <form action="login.php" method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" required />
            <input type="password" name="password" placeholder="Mật khẩu" required />
            <button type="submit">Đăng nhập</button>
            <!-- Error message (display dynamically using PHP) -->
            <?php
            if (isset($error)) {
                echo "<p class='error-message'>$error</p>";
            }
            ?>
            <p class="message">Chưa có tài khoản? <a href="register.php">Đăng ký</a></p>
        </form>
    </div>
</body>

</html>

