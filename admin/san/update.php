<?php
require_once "../layout/header.php";
require_once "../../connect.php";

// Check if an ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];  // Get the ID from the URL
    
    // Fetch the existing data for the given ID
    $sql = "SELECT * FROM tbl_san WHERE idsan = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    // If a record is found, pre-populate the form
    $existingPitch = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$existingPitch) {
        // If no record is found with that ID, show an error message
        echo "<script>alert('Sân bóng không tồn tại!'); window.location.href = 'list.php';</script>";
        exit();
    }
    
    // If the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $pitchName = $_POST['pitchName'];
        $pitchType = $_POST['pitchType'];
        $price = $_POST['price'];

        // Check if the fields are not empty
        if (!empty($pitchName) && !empty($pitchType) && !empty($price)) {
            try {
                // Update the record in the database
                $sql = "UPDATE tbl_san SET tensan = :tensan, loaisan = :loaisan, dongia = :dongia WHERE idsan = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':tensan', $pitchName);
                $stmt->bindParam(':loaisan', $pitchType);
                $stmt->bindParam(':dongia', $price);
                $stmt->bindParam(':id', $id);

                if ($stmt->execute()) {
                    echo "<script>
                            alert('Sân bóng đã được cập nhật thành công!');
                            window.location.href = 'list.php?success=1';
                          </script>";
                    exit();  // Prevent further execution
                } else {
                    echo "<script>
                            alert('Lỗi: Không thể cập nhật sân!');
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
    echo "<script>alert('Không tìm thấy sân bóng!'); window.location.href = 'list.php';</script>";
    exit();
}
?>

<div class="wrapper">
    <?php require_once "../layout/nav.php"; ?>
    <div id="content">
        <h1>Cập nhật sân bóng</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- Update form -->
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="pitchName">Tên sân:</label>
                        <input type="text" class="form-control" id="pitchName" name="pitchName" placeholder="Nhập tên sân" value="<?php echo htmlspecialchars($existingPitch['tensan']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="pitchType">Loại sân:</label>
                        <select class="form-control" id="pitchType" name="pitchType" required>
                            <option value="">-- Chọn loại sân --</option>
                            <?php
                            // Fetch available pitch types to display in the dropdown
                            $sql = "SELECT idloaisan, loaisan FROM tbl_loaisan";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $loaisanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($loaisanList as $loaisan) {
                                // Check if this type was selected in the existing record
                                $selected = ($loaisan['idloaisan'] == $existingPitch['loaisan']) ? 'selected' : '';
                                echo "<option value='" . $loaisan['idloaisan'] . "' $selected>" . $loaisan['loaisan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Đơn giá (VNĐ):</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sân" value="<?php echo htmlspecialchars($existingPitch['dongia']); ?>" required>
                    </div>
                    <button type="submit" class="btn btn-warning btn-block">Cập nhật sân</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<?php require_once "../layout/footer.php"; ?>
