<?php
require_once "../../connect.php"; 

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $sql = "SELECT * FROM tbl_taikhoan WHERE id_taikhoan = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $deleteSql = "DELETE FROM tbl_taikhoan WHERE id_taikhoan = :id";
            $deleteStmt = $conn->prepare($deleteSql);
            $deleteStmt->bindParam(':id', $id);

            if ($deleteStmt->execute()) {
                header("Location: list.php?success=1");
                exit();
            } else {
                // Error during deletion
                echo "<script>alert('Lỗi: Không thể xoá người dùng!'); window.location.href = 'list.php';</script>";
            }
        } else {
            echo "<script>alert('Người dùng không tồn tại!'); window.location.href = 'list.php';</script>";
        }
    } catch (Exception $e) {
        echo "<script>alert('Lỗi: " . $e->getMessage() . "'); window.location.href = 'list.php';</script>";
    }
} else {
    echo "<script>alert('Không tìm thấy người dùng!'); window.location.href = 'list.php';</script>";
}
?>
