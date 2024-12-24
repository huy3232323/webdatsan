<?php
require_once "../layout/header.php";
require_once "../../connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pitchName = $_POST['pitchName'];
    $pitchType = $_POST['pitchType'];
    $price = $_POST['price'];

    // Check if the fields are not empty
    if (!empty($pitchName) && !empty($pitchType) && !empty($price)) {
        try {
            // Fetch the largest id (handling case when the table might be empty)
            $sql = "SELECT MAX(idsan) AS max_id FROM tbl_san";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            // If no records exist in the table, set the new ID to 1
            $newId = ($result['max_id'] !== null) ? $result['max_id'] + 1 : 1;

            // Insert the new record with the new id
            $sql = "INSERT INTO tbl_san (idsan, tensan, loaisan, dongia, createdDate) 
                    VALUES (:id, :tensan, :loaisan, :dongia, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $newId);  // Bind the new id
            $stmt->bindParam(':tensan', $pitchName);
            $stmt->bindParam(':loaisan', $pitchType);
            $stmt->bindParam(':dongia', $price);

            if ($stmt->execute()) {
                // Show a success alert and redirect to list page
                echo "<script>
                        alert('Sân bóng đã được thêm thành công!');
                        window.location.href = 'list.php?success=1';
                      </script>";
                exit(); // Ensure no further code is executed
            } else {
                // Show an error alert
                echo "<script>
                        alert('Lỗi: Không thể thêm sân!');
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
} else {
    // Empty else block or you could handle other cases here
}
?>


<div class="wrapper">
    <?php require_once "../layout/nav.php"; ?>
    <div id="content">
        <h1>Thêm sân bóng</h1>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="pitchName">Tên sân:</label>
                        <input type="text" class="form-control" id="pitchName" name="pitchName" placeholder="Nhập tên sân" required>
                    </div>
                    <div class="form-group">
                        <label for="pitchType">Loại sân:</label>
                        <select class="form-control" id="pitchType" name="pitchType" required>
                            <option value="">-- Chọn loại sân --</option>
                            <?php
                            $sql = "SELECT idloaisan, loaisan FROM tbl_loaisan";
                            $stmt = $conn->prepare($sql);
                            $stmt->execute();
                            $loaisanList = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($loaisanList as $loaisan) {
                                echo "<option value='" . $loaisan['idloaisan'] . "'>" . $loaisan['loaisan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="price">Đơn giá (VNĐ):</label>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Nhập giá sân" required>
                    </div>
                    <button type="submit" class="btn btn-success btn-block">Thêm sân</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<?php require_once "../layout/footer.php"; ?>
