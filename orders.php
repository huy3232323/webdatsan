<?php
require_once "header.php";
require_once "connect.php";

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to view invoices.";
    exit();
}

$userId = $_SESSION['user_id']; // Get the user_id from the session

try {
    $sql = "SELECT * FROM tbl_hoadon WHERE iduser = :userId ORDER BY createdDate DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();

    $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<style>
    /* Modal background */
    .modal {
        display: none;
        /* Mặc định là ẩn */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        /* Nền mờ */
        justify-content: center;
        align-items: center;
    }

    /* Modal content */
    .modal-dialog {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        max-width: 600px;
        width: 100%;
    }

    /* Header */
    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Close button */
    .close-btn {
        font-size: 20px;
        cursor: pointer;
    }

    /* Footer */
    .modal-footer {
        text-align: right;
    }
</style>

<div class="wrapper">
    <?php require_once "nav.php"; ?>
    <div class="header-web">
        <div class="form-inline">
            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
                <span>Toggle Sidebar</span>
            </button>
            <?php if (isset($_SESSION['username'])): ?>
                <a href="orders.php" class="btn btn-warning btn-register">Đơn đặt của tôi </a>
                <a href="logout.php" type="button" name="logout" class="btn btn-warning btn-register">Đăng xuất </a>
            <?php else: ?>
                <a href="register.php" type="button" name="register" class="btn btn-warning btn-register">Đăng ký </a>
                <a href="login.php" type="button" name="login" class="btn btn-success btn-login" style="margin-right: 10px;">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>


    <style>
        /* Wrapper tổng thể */
        .wrapper {
            width: 100%;
        }

        /* Header web */
        .header-web {
            display: flex;
            justify-content: flex-end; /* Đẩy nội dung sang phải */
            align-items: center;
            background-color:#F8F9FA;
            color: white;
            padding: 35px 19px;

            position: fixed;
            width: calc(98% - 240px); /* Bù chiều rộng của sidebar */
            top: 0;
            z-index: 1000;
        }

        /* Nút đăng ký/đăng nhập/đăng xuất */
        .btn-register, .btn-login {
            font-size: 14px;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            color: #fff;
            text-transform: uppercase;
            transition: all 0.3s ease-in-out;
            margin-left: 10px; /* Khoảng cách giữa các nút */
        }

        .btn-warning {
            background-color: #2575FC;
            border: none;
        }

        .btn-warning:hover {
            background-color: #ec971f;
            transform: translateY(-2px);
        }

        .btn-success {
            background-color: #5cb85c;
            border: none;
        }

        .btn-success:hover {
            background-color: #4cae4c;
            transform: translateY(-2px);
        }

        /* Responsive cho màn hình nhỏ */
        @media (max-width: 768px) {
            .header-web {
                flex-direction: column;
                align-items: flex-start;
                padding: 15px;
            }

            .form-inline {
                margin-top: 10px;
                display: flex;
                flex-wrap: wrap;
                gap: 10px;
            }
        }
    </style>

    <div id="content">
        <h1>Đơn đặt sân</h1>
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
                            <td><?= htmlspecialchars($invoice['status']) ?></td>
                            <td><?= htmlspecialchars($invoice['updatedDate']) ?></td>
                            <td><?= htmlspecialchars($invoice['createdDate']) ?></td>
                            <td>
                                <button class="btn btn-info btn-view-details" data-id="<?= $invoice['idhoadon'] ?>">Xem chi tiết</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<style>
    /* Đảm bảo phần content không bị che */
#content {
    margin: 0px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-left: 250px; /* Cách lề trái 250px để tránh bị sidebar che */
    margin-top: 80px; /* Cách phần trên header 80px */
    overflow-x: auto; /* Thêm thanh cuộn ngang nếu bảng quá rộng */
}

/* Bảng hóa đơn */
.table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    margin-top: 20px; /* Thêm khoảng cách với tiêu đề */
}

.table th {
    background: #2575fc;
    color: white;
    text-align: left;
    padding: 50px;
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
    background: #f2f2f2;
}

.table tbody tr:hover {
    background: #e9f5ff;
}

/* Header */
.header-web {
    display: flex;
    justify-content: flex-end; /* Đẩy các nút sang phải */
    align-items: center;
    background: #F8F9FA;
    color: white;
    padding: 20px;
    position: fixed;
    top: 0;
    left: 260px; /* Cách sidebar */
    width: calc(100% - 250px); /* Điều chỉnh để không bị sidebar che */
    z-index: 1000;
    
}

/* Responsive: Ẩn sidebar và chỉnh lại header khi màn hình nhỏ */
@media (max-width: 768px) {
    #content {
        margin-left: 0; /* Sidebar sẽ được ẩn */
        margin-top: 80px;
    }

    .header-web {
        left: 0;
        width: 100%;
    }
}

</style>

    <!-- Modal -->
    <div id="invoiceDetailsModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h5 class="modal-title">Chi tiết hóa đơn</h5>
                <span class="close-btn">&times;</span>
            </div>
            <div class="modal-body">
                <!-- Service details will be loaded here -->
                <div id="serviceList"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeModalBtn">Đóng</button>
            </div>
        </div>
    </div>




</div>

<?php require_once "footer.php"; ?>

<script>
    $(document).ready(function() {
        // Khi nhấn nút "Xem chi tiết"
        $(".btn-view-details").click(function() {
            var invoiceId = $(this).data('id'); // Lấy id hóa đơn

            // Gửi yêu cầu AJAX để lấy chi tiết dịch vụ cho hóa đơn này
            $.ajax({
                url: 'get_invoice_details.php', // Endpoint lấy thông tin dịch vụ
                type: 'GET',
                data: {
                    idhoadon: invoiceId
                },
                success: function(response) {
                    // Hiển thị dịch vụ trong modal
                    $('#serviceList').html(response);
                    // Hiển thị modal
                    $('#invoiceDetailsModal').fadeIn();
                },
                error: function(error) {
                    console.error(error)
                    alert('Có lỗi xảy ra khi tải chi tiết!');
                }
            });
        });

        // Đóng modal khi nhấn vào nút "Đóng"
        $('#closeModalBtn').click(function() {
            $('#invoiceDetailsModal').fadeOut();
        });

        // Đóng modal khi nhấn vào nút đóng (x)
        $('.close-btn').click(function() {
            $('#invoiceDetailsModal').fadeOut();
        });

        // Đóng modal nếu nhấn ra ngoài modal
        $(window).click(function(event) {
            if (event.target == document.getElementById('invoiceDetailsModal')) {
                $('#invoiceDetailsModal').fadeOut();
            }
        });
    });
</script>