<?php
require_once "../layout/header.php";
require_once "../../connect.php";

// Check if an ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];  // Get the ID from the URL
    
    // Fetch the existing data for the given ID
    $sql = "SELECT * FROM tbl_taikhoan WHERE id_taikhoan = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    // If a record is found, pre-populate the form
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$existingUser) {
        // If no record is found with that ID, show an error message
        echo "<script>alert('Người dùng không tồn tại!'); window.location.href = 'list.php';</script>";
        exit();
    }
    
    // If the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $idkh = $_POST['idkh'];
        $trangthai = $_POST['trangthai'];
        $idrole = $_POST['idrole'];

        // Check if the fields are not empty
        if (!empty($username) && !empty($idkh) && !empty($trangthai) && !empty($idrole)) {
            try {
                // Update the record in the database
                $sql = "UPDATE tbl_taikhoan SET username = :username, password = :password, idkh = :idkh, trangthai = :trangthai, idrole = :idrole WHERE id_taikhoan = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':password', $password);
                $stmt->bindParam(':idkh', $idkh);
                $stmt->bindParam(':trangthai', $trangthai);
                $stmt->bindParam(':idrole', $idrole);
                $stmt->bindParam(':id', $id);

                if ($stmt->execute()) {
                    echo "<script>
                            alert('Thông tin người dùng đã được cập nhật thành công!');
                            window.location.href = 'list.php?success=1';
                          </script>";
                    exit();  // Prevent further execution
                } else {
                    echo "<script>
                            alert('Lỗi: Không thể cập nhật người dùng!');
                          </script>";
                }
            } catch (Exception $e) {
                // Show an error alert with the exception message
                echo "<script>
                        alert('Lỗi: " . $e->getMessage() . "');
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Vui lòng nhập đầy đủ thông tin!');
                  </script>";
        }
    }
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href = 'list.php';</script>";
    exit();
}
?>

<div class="wrapper">
    <?php require_once "../layout/nav.php"; ?>
    <div id="content">
        <h1>Cập nhật thông tin người dùng</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Update form -->
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="username">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập" value="<?php echo htmlspecialchars($existingUser['username']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Mật khẩu:</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" value="<?php echo htmlspecialchars($existingUser['password']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="idkh">Khách hàng ID:</label>
                        <input type="text" class="form-control" id="idkh" name="idkh" placeholder="Nhập ID khách hàng" value="<?php echo htmlspecialchars($existingUser['idkh']); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="trangthai">Trạng thái:</label>
                        <select class="form-control" id="trangthai" name="trangthai" required>
                            <option value="1" <?php echo ($existingUser['trangthai'] == 1) ? 'selected' : ''; ?>>Hoạt động</option>
                            <option value="0" <?php echo ($existingUser['trangthai'] == 0) ? 'selected' : ''; ?>>Không hoạt động</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="idrole">Vai trò:</label>
                        <select class="form-control" id="idrole" name="idrole" required>
                            <option value="1" <?php echo ($existingUser['idrole'] == 1) ? 'selected' : ''; ?>>Admin</option>
                            <option value="2" <?php echo ($existingUser['idrole'] == 2) ? 'selected' : ''; ?>>Khách hàng</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-warning btn-block">Cập nhật người dùng</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<?php require_once "../layout/footer.php"; ?>
