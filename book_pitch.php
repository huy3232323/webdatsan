<?php
require_once "connect.php";

function generateInvoiceId($conn)
{
    $prefix = "HD"; // Tiền tố của mã hóa đơn
    $invoiceId = "";

    // Truy vấn để lấy mã hóa đơn lớn nhất hiện tại
    $sql = "SELECT idhoadon FROM tbl_hoadon ORDER BY idhoadon DESC LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $lastInvoiceId = $stmt->fetchColumn();

    // Kiểm tra xem có mã hóa đơn nào tồn tại không
    if ($lastInvoiceId) {
        // Lấy phần số từ mã hóa đơn (bỏ phần 'HD')
        $lastNumber = (int) substr($lastInvoiceId, 2); // Từ "HD001" chỉ lấy 001
        $newNumber = $lastNumber + 1; // Tăng số lên 1
    } else {
        // Nếu không có hóa đơn nào, bắt đầu từ 1
        $newNumber = 1;
    }

    // Đảm bảo rằng số mới có 3 chữ số (ví dụ: 001, 002, 003)
    $newNumber = str_pad($newNumber, 3, "0", STR_PAD_LEFT);

    // Tạo mã hóa đơn mới
    $invoiceId = $prefix . $newNumber;

    return $invoiceId;
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pitchId = $_POST['pitchId'];
    $timeStart = $_POST['timeStart'];
    $timeEnd = $_POST['timeEnd'];
    $services = isset($_POST['services']) ? $_POST['services'] : [];

    session_start();
    $userId = $_SESSION['user_id'];

    // Kiểm tra xem sân đã có người đặt trong khoảng thời gian này chưa
    $sql = "SELECT COUNT(*) FROM tbl_hoadon 
            WHERE idsan = :pitchId 
            AND ((:timeStart BETWEEN timeStart AND timeEnd) OR (:timeEnd BETWEEN timeStart AND timeEnd) OR (timeStart BETWEEN :timeStart AND :timeEnd)) 
            AND status != 1";  // status != 1 nghĩa là hóa đơn chưa được thanh toán

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pitchId', $pitchId);
    $stmt->bindParam(':timeStart', $timeStart);
    $stmt->bindParam(':timeEnd', $timeEnd);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        echo "Lỗi: Sân đã được đặt trong khoảng thời gian này.";
        exit;  // Dừng xử lý nếu sân đã được đặt
    }

    // Tạo mã hóa đơn duy nhất
    $invoiceId = generateInvoiceId($conn);

    // Chèn thông tin vào bảng tbl_hoadon
    $sql = "INSERT INTO tbl_hoadon (idhoadon, idsan, iduser, timeStart, timeEnd, ngaydat, tongthanhtoan, status, createdDate, updatedDate)
                VALUES (:invoiceId, :pitchId, :userId, :timeStart, :timeEnd, NOW(), 0, 0, NOW(), NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':invoiceId', $invoiceId); // Lưu id hóa đơn
    $stmt->bindParam(':pitchId', $pitchId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':timeStart', $timeStart);
    $stmt->bindParam(':timeEnd', $timeEnd);
    $stmt->execute();

    // Tính toán tổng tiền
    $totalAmount = 0;
    foreach ($services as $serviceId) {
        $sql = "SELECT dongia FROM tbl_dichvu WHERE iddichvu = :serviceId";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':serviceId', $serviceId);
        $stmt->execute();
        $service = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($service) {
            $serviceAmount = $service['dongia'];
            $totalAmount += $serviceAmount;

            // Chèn dịch vụ vào bảng tbl_hoadondichvu
            $sql = "INSERT INTO tbl_hoadondichvu (iddichvu, idhoadon, dongia, soluong, thanhtien, createdDate, updatedDate)
                        VALUES (:serviceId, :invoiceId, :serviceAmount, 1, :serviceAmount, NOW(), NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':serviceId', $serviceId);
            $stmt->bindParam(':invoiceId', $invoiceId);
            $stmt->bindParam(':serviceAmount', $serviceAmount);
            $stmt->execute();
        }
    }

    // Cập nhật tổng thanh toán vào bảng tbl_hoadon
    $sql = "UPDATE tbl_hoadon SET tongthanhtoan = :totalAmount WHERE idhoadon = :invoiceId";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':totalAmount', $totalAmount);
    $stmt->bindParam(':invoiceId', $invoiceId);
    $stmt->execute();

    echo "success";
}
