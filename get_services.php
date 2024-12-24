<?php
require_once "connect.php";  // Kết nối cơ sở dữ liệu

if (isset($_GET['pitchId'])) {
    $pitchId = $_GET['pitchId'];

    try {
        // Lấy danh sách dịch vụ cho sân
        $sql = "SELECT * FROM tbl_dichvu";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($services) {
            foreach ($services as $service) {
                echo '<div class="form-check">
                        <input type="checkbox" class="form-check-input" name="services[]" value="' . $service['iddichvu'] . '">
                        <label class="form-check-label">' . htmlspecialchars($service['tendichvu']) . ' - ' . number_format($service['dongia'], 0, ',', '.') . ' VND</label>
                    </div>';
            }
        } else {
            echo '<p>Không có dịch vụ nào cho sân này.</p>';
        }
    } catch (Exception $e) {
        echo "Lỗi: " . $e->getMessage();
    }
}
?>
