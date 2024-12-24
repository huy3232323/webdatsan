<?php
require_once "../../connect.php"; // Make sure the DB connection is correct

// Check if 'id' is passed via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id']; // Get the ID from the URL
    
    try {
        // Check if the pitch exists before attempting to delete
        $sql = "SELECT * FROM tbl_san WHERE idsan = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // If the record exists, delete it
        if ($stmt->rowCount() > 0) {
            // Prepare and execute DELETE statement
            $deleteSql = "DELETE FROM tbl_san WHERE idsan = :id";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bindParam(':id', $id);
            
            if ($deleteStmt->execute()) {
                // Redirect with success message after deletion
                header("Location: list.php?success=1");
                exit();
            } else {
                // If delete fails, show an error message
                echo "<script>alert('Lỗi: Không thể xoá sân!'); window.location.href = 'list.php';</script>";
            }
        } else {
            // If the pitch doesn't exist, show an error message
            echo "<script>alert('Sân bóng không tồn tại!'); window.location.href = 'list.php';</script>";
        }
    } catch (Exception $e) {
        // Handle any exceptions (DB errors)
        echo "<script>alert('Lỗi: " . $e->getMessage() . "'); window.location.href = 'list.php';</script>";
    }
} else {
    // If 'id' is not passed, show an error message
    echo "<script>alert('Không tìm thấy sân bóng!'); window.location.href = 'list.php';</script>";
}
?>
