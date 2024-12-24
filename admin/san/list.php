<?php
require_once "../layout/header.php";

try {
    $sql = "SELECT idsan, tensan, loaisan, dongia, createdDate FROM tbl_san ORDER BY createdDate DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $pitches = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<div class="wrapper">
    <?php require_once "../layout/nav.php"; ?>
    <div id="content">
        <h1>Trang quản lý</h1>
        <div class="row">
            <p><a class="btn btn-success" href="<?php echo BASE_ADMIN_URL; ?>san/add.php">Thêm sân</a></p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Mã sân</th>
                        <th>Tên sân</th>
                        <th>Loại sân</th>
                        <th>Đơn giá</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pitches as $pitch): ?>
                        <tr class="sandisplay">
                            <td><?= htmlspecialchars($pitch['idsan']) ?></td>
                            <td><?= htmlspecialchars($pitch['tensan']) ?></td>
                            <td><?= htmlspecialchars($pitch['loaisan']) ?></td>
                            <td><?= number_format($pitch['dongia'], 0, ',', '.') ?> VND</td>
                            <td><?= htmlspecialchars($pitch['createdDate']) ?></td>
                            <td>
                                <a class="btn btn-warning" href="<?php echo BASE_ADMIN_URL; ?>san/update.php?id=<?php echo $pitch['idsan']; ?>">Sửa</a>
                                <a class="btn btn-danger" href="<?php echo BASE_ADMIN_URL; ?>san/delete.php?id=<?php echo $pitch['idsan']; ?>">Xoá</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    /* Wrapper tổng thể */
.wrapper {
    width: 100%;
    margin: 0 auto;
    background-color: #f9f9f9;
    padding: 20px;
}

/* Content Section */
#content {
    margin-left: 250px; /* Khoảng cách với sidebar */
    margin-top: 80px; /* Khoảng cách với header */
    padding: 30px;
    background: #ffffff; /* Nền trắng cho nội dung */
    border-radius: 8px;

    overflow-x: auto; /* Thanh cuộn ngang nếu nội dung quá lớn */
}

/* Tiêu đề */
#content h1 {
    font-size: 24px;
    color: #333;
    margin-bottom: 20px;
    font-weight: bold;
    text-transform: uppercase;
    text-align: left;
}

/* Nút "Thêm sân" */
.btn-success {
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    padding: 10px 15px;
    border-radius: 5px;
    color: #fff;
    background-color: #5cb85c;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
    display: inline-block;
}

.btn-success:hover {
    background-color: #4cae4c; /* Màu xanh đậm khi hover */
    transform: translateY(-2px); /* Hiệu ứng nhấn */
}

/* Bảng */
.table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 20px; /* Khoảng cách với các thành phần khác */
}

.table th {
    background: #2575fc; /* Màu xanh đậm */
    color: white;
    text-align: left;
    padding: 12px 15px;
    font-weight: bold;
    text-transform: uppercase;
    font-size: 14px;
}

.table td {
    padding: 12px 15px;
    border-bottom: 1px solid #ddd;
    font-size: 14px;
    color: #333;
}

.table tbody tr:nth-child(even) {
    background: #f2f2f2; /* Màu nền xen kẽ */
}

.table tbody tr:hover {
    background: #e9f5ff; /* Màu nền khi hover */
}

/* Nút "Sửa" và "Xóa" */
.btn-warning, .btn-danger {
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    border: none;
    transition: all 0.3s ease-in-out;
    text-decoration: none;
}

.btn-warning {
    background-color: #f0ad4e; /* Màu vàng */
}

.btn-warning:hover {
    background-color: #ec971f;
    transform: translateY(-2px);
}

.btn-danger {
    background-color: #d9534f; /* Màu đỏ */
}

.btn-danger:hover {
    background-color: #c9302c;
    transform: translateY(-2px);
}

/* Responsive: Ẩn sidebar khi màn hình nhỏ */
@media (max-width: 768px) {
    #content {
        margin-left: 0; /* Bỏ khoảng cách với sidebar */
        margin-top: 80px; /* Khoảng cách với header */
        padding: 10px;
    }

    .table th, .table td {
        font-size: 12px; /* Giảm kích thước chữ */
        padding: 8px;
    }
}

</style>

<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<?php
  require_once "../layout/footer.php";
?>


