<?php
require_once "../layout/header.php";

try {
    // Fetch all records from tbl_hoadon
    $sql = "SELECT * FROM tbl_hoadon ORDER BY createdDate DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<div class="wrapper">
    <?php require_once "../layout/nav.php"; ?>
    <div id="content">
        <h1>Trang quản lý hóa đơn</h1>
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th>Mã hóa đơn</th>
                        <th>ID sân</th>
                        <th>ID người dùng</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Ngày đặt</th>
                        <th>Tổng thanh toán</th>
                        <th>Trạng thái</th>
                        <th>Ngày cập nhật</th>
                        <th>Ngày tạo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($invoices as $invoice): ?>
                        <tr class="hoadon-display">
                            <td><?= htmlspecialchars($invoice['idhoadon']) ?></td>
                            <td><?= htmlspecialchars($invoice['idsan']) ?></td>
                            <td><?= htmlspecialchars($invoice['iduser']) ?></td>
                            <td><?= htmlspecialchars($invoice['timeStart']) ?></td>
                            <td><?= htmlspecialchars($invoice['timeEnd']) ?></td>
                            <td><?= htmlspecialchars($invoice['ngaydat']) ?></td>
                            <td><?= number_format($invoice['tongthanhtoan'], 0, ',', '.') ?> VND</td>
                            <td>
                                <!-- Dropdown to change status -->
                                <select class="status-select" data-id="<?= $invoice['idhoadon'] ?>">
                                    <option value="1" <?= $invoice['status'] == 1 ? 'selected' : '' ?>>Đã duyệt</option>
                                    <option value="0" <?= $invoice['status'] == 2 ? 'selected' : '' ?>>Chờ duyệt</option>
                                    <option value="0" <?= $invoice['status'] == 0 ? 'selected' : '' ?>>Huỷ</option>
                                </select>
                            </td>
                            <td><?= htmlspecialchars($invoice['updatedDate']) ?></td>
                            <td><?= htmlspecialchars($invoice['createdDate']) ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<style>
    /* Tổng thể wrapper */
.wrapper {
    width: 100%;
    margin: 0 auto;
    background-color: #f9f9f9;
    padding: 20px;
}

/* Content Section */
#content {
    margin-left: 250px; /* Khoảng cách từ sidebar */
    margin-top: 80px; /* Khoảng cách từ header */
    padding: 30px;
    background: #ffffff; /* Nền trắng */
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Hiệu ứng đổ bóng */
    overflow-x: auto; /* Thanh cuộn ngang */
}

/* Tiêu đề */
#content h1 {
    font-size: 24px;
    color: #333;
    font-weight: bold;
    text-transform: uppercase;
    margin-bottom: 20px;
}

/* Bảng */
.table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.table th {
    background: #2575fc; /* Màu xanh header */
    color: #fff;
    padding: 12px 15px;
    font-weight: bold;
    text-align: left;
    text-transform: uppercase;
    font-size: 14px;
}

.table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
    color: #333;
    white-space: nowrap; /* Không xuống dòng */
}

.table tbody tr:nth-child(even) {
    background-color: #f9f9f9; /* Màu nền xen kẽ */
}

.table tbody tr:hover {
    background-color: #e9f5ff; /* Màu nền khi hover */
}

/* Dropdown trạng thái */
.status-select {
    font-size: 14px;
    padding: 5px 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background-color: #fff;
    color: #333;
    cursor: pointer;
    transition: all 0.3s ease;
}

.status-select:hover {
    border-color: #4b79a1; /* Viền đổi màu khi hover */
}

/* Dropdown: màu sắc theo trạng thái */
.status-select option[value="1"] {
    color: #5cb85c; /* Đã duyệt */
}
.status-select option[value="2"] {
    color: #f0ad4e; /* Chờ duyệt */
}
.status-select option[value="0"] {
    color: #d9534f; /* Huỷ */
}

/* Responsive */
@media (max-width: 768px) {
    #content {
        margin-left: 0;
        margin-top: 80px;
        padding: 10px;
    }

    .table th, .table td {
        font-size: 12px;
        padding: 8px;
    }

    .status-select {
        font-size: 12px;
        padding: 5px;
    }
}

</style>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<?php
require_once "../layout/footer.php";
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle the change event of the status dropdown
        $(".status-select").change(function() {
            var status = $(this).val();  // New status value
            var id = $(this).data("id"); // Get the invoice ID
            
            $.ajax({
                url: 'change_status.php', 
                type: 'POST',
                data: {
                    id: id,
                    status: status
                },
                success: function(response) {
                    console.log(response)
                    if(response == 'success') {
                        alert('Trạng thái đã được cập nhật!');
                    } else {
                        alert('Lỗi khi thay đổi trạng thái!');
                    }
                },
                error: function() {
                    alert('Có lỗi xảy ra khi thay đổi trạng thái!');
                }
            });
        });
    });
</script>
