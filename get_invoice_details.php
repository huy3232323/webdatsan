<?php
// Kết nối cơ sở dữ liệu
require_once 'connect.php';

if (isset($_GET['idhoadon'])) {
    $invoiceId = $_GET['idhoadon'];

    try {
        // Kết hợp ba bảng để lấy thông tin dịch vụ của hóa đơn
        $sql = "
            SELECT d.tendichvu, d.dongia
            FROM tbl_dichvu d
            JOIN tbl_hoadondichvu hdv ON hdv.iddichvu = d.iddichvu
            WHERE hdv.idhoadon = :invoiceId
        ";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':invoiceId', $invoiceId);
        $stmt->execute();
        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($services) {
            // Hiển thị danh sách dịch vụ
            foreach ($services as $service) {
                echo "<p>Dịch vụ: " . htmlspecialchars($service['tendichvu']) . " - Giá: " . number_format($service['dongia'], 0, ',', '.') . " VND</p>";
            }
        } else {
            echo "<p>Không có dịch vụ nào cho hóa đơn này.</p>";
        }
    } catch (PDOException $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>
