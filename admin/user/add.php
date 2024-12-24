<?php
require_once "../layout/header.php";
require_once "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $idkh = $_POST['idkh'];  // ID of the customer
    $status = $_POST['status'];  // Status of the user
    $role = $_POST['role'];  // Role of the user

    // Check if the fields are not empty
    if (!empty($username) && !empty($password) && !empty($idkh) && !empty($status) && !empty($role)) {
        try {
            // Hash the password before storing it (for security)
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Insert the new record into tbl_taikhoan
            $sql = "INSERT INTO tbl_taikhoan (username, password, idkh, trangthai, idrole, createdDate, updatedDate) 
                    VALUES (:username, :password, :idkh, :trangthai, :idrole, NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':idkh', $idkh);
            $stmt->bindParam(':trangthai', $status);
            $stmt->bindParam(':idrole', $role);

            if ($stmt->execute()) {
                // Success: Show alert and redirect to list page
                echo "<script>
                        alert('Người dùng đã được thêm thành công!');
                        window.location.href = 'list.php?success=1';
                      </script>";
                exit(); // Stop further execution after redirect
            } else {
                // Show an error alert if the insertion failed
                echo "<script>
                        alert('Lỗi: Không thể thêm người dùng!');
                      </script>";
            }
        } catch (Exception $e) {
            // Show an error alert with the exception message
            echo "<script>
                    alert('Lỗi: " . $e->getMessage() . "');
                  </script>";
        }
    } else {
        // Show an alert if any required field is missing
        echo "<script>
                alert('Vui lòng nhập đầy đủ thông tin!');
              </script>";
    }
}
?>

<div class="wrapper">
    <?php require_once "../layout/nav.php"; ?>
    <div id="content">
        <h1>Thêm người dùng</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="#" method="POST">
                    <!-- Username Field -->
                    <div class="form-group">
                        <label for="username">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                    </div>

                    <!-- Password Field -->
                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                    </div>

                    <!-- Customer ID (idkh) -->
                    <div class="form-group">
                        <label for="idkh">ID Khách hàng:</label>
                        <input type="text" class="form-control" id="idkh" name="idkh" placeholder="Nhập ID khách hàng" required>
                    </div>

                    <!-- User Status -->
                    <div class="form-group">
                        <label for="status">Trạng thái:</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <!-- User Role -->
                    <div class="form-group">
                        <label for="role">Vai trò:</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="">-- Chọn vai trò --</option>
                            <option value="1">Admin</option>
                            <option value="2">Nhân viên</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-success btn-block">Thêm người dùng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<?php require_once "../layout/footer.php"; ?>
