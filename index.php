<?php
require_once "header.php";
require_once "connect.php";

try {
    $sql = "SELECT * FROM tbl_san LIMIT 8";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $pitches = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Lỗi: " . $e->getMessage();
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


    <?php require_once "nav.php"; ?>
    <div class="header-web">
        <div class="form-inline">
            <?php if (isset($_SESSION['username'])): ?>
                <a href="orders.php" class="btn btn-warning btn-register">Đơn đặt của tôi</a>
                <a href="logout.php" type="button" name="logout" class="btn btn-warning btn-register">Đăng xuất</a>
            <?php else: ?>
                <a href="register.php" type="button" name="register" class="btn btn-warning btn-register">Đăng ký</a>
                <a href="login.php" type="button" name="login" class="btn btn-success btn-login">Đăng nhập</a>
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
            background-color: #F5F5F5;
            color: white;
            padding: 28px 25px;
            position: fixed;
            width: calc(99% - 245px); /* Bù chiều rộng của sidebar */
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
            background-color: #f0ad4e;
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
</div>




    <div id="content">
        <h1>Trang đặt sân nhanh</h1>
        <div class="row">
            <?php if (!empty($pitches)): ?>
                <?php foreach ($pitches as $pitch): ?>
                    <div class="col-sm-3 display-pitch text-center">
                        <h3 class="text-center pitch-name"><?= htmlspecialchars($pitch['tensan']) ?></h3>
                        <img src="image/san.png" alt="<?= htmlspecialchars($pitch['tensan']) ?>">
                        <p class="text-center price-pitch">
                            Giá:<span style="padding-left: 10px; padding-right: 5px;">
                                <?= number_format($pitch['dongia'], 0, ',', '.') ?>
                            </span>đ
                        </p>
                        <p class="text-center">
                            <!-- Thêm thuộc tính onclick để gọi hàm choosesan -->
                            <input type="button" name="datsan" id="btnDatSan"
                                class="btn btn-primary"
                                value="Đặt sân"
                                onclick="choosesan(<?= $pitch['idsan'] ?>)" />
                        </p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Không có sân nào để hiển thị.</p>
            <?php endif; ?>
        </div>
    </div>
    <head>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
  <style type="text/css">
    /* Áp dụng font Poppins */
    body {
      font-family: 'Poppins', sans-serif;
    }

    /* Toàn bộ nội dung */
    #content {
      margin-left: 260px; /* Dành chỗ cho sidebar */
      padding: 20px;
      background: #f5f5f5;
      min-height: 100vh;
    }

    #content h1 {
      font-size: 38px; /* Tăng kích thước */
      font-weight: bold;
      color: #fff;
      text-transform: uppercase;
      text-align: center;
      margin-bottom: 30px;
      background: linear-gradient(135deg, #6a11cb, #2575fc); /* Hiệu ứng gradient */
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent; /* Hiệu ứng chữ trong suốt */
      letter-spacing: 2px;
    }

    /* Hàng hiển thị các sân */
    .row {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
    }

    /* Mỗi khối sân */
    .display-pitch {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 260px;
      transition: all 0.3s ease-in-out;
      position: relative;
    }

    /* Hiệu ứng hover trên khối sân */
    .display-pitch:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
    }

    /* Tên sân */
    .pitch-name {
      font-size: 20px;
      font-weight: 600; /* Font đậm vừa */
      color: #2575fc; /* Màu xanh bắt mắt */
      margin-bottom: 15px;
      text-transform: uppercase;
    }

    /* Ảnh sân */
    .display-pitch img {
      max-width: 100%;
      border-radius: 8px;
      margin-bottom: 15px;
    }

    /* Giá sân */
    .price-pitch {
      font-size: 16px;
      color: #444;
      margin-bottom: 15px;
    }

    .price-pitch span {
      font-weight: 600; /* Font đậm hơn */
      color: #2575fc;
    }

    /* Nút đặt sân */
    .btn {
      display: inline-block;
      padding: 10px 15px;
      font-size: 14px;
      font-weight: bold;
      text-transform: uppercase;
      color: #fff;
      background-color: #2575fc;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
    }

    .btn:hover {
      background-color: #6a11cb; /* Gradient xanh tím */
    }

    /* Thông báo khi không có sân */
    #content p {
      text-align: center;
      font-size: 18px;
      color: #666;
    }
  </style>
</head>


    <!-- Modal -->
    <div id="bookPicthModal" class="modal">
        <div class="modal-dialog">
            <div class="modal-header">
                <h5 class="modal-title">Chọn dịch vụ</h5>
                <span class="close-btn" id="closeModalBtn">&times;</span>
            </div>
            <div class="modal-body">
                <form id="bookingForm">
                    <input type="hidden" id="pitchId" name="pitchId">
                    <div id="serviceList"></div>
                    <div class="form-group">
                        <label for="timeStart">Thời gian bắt đầu:</label>
                        <input type="datetime-local" class="form-control" id="timeStart" name="timeStart" required>
                    </div>
                    <div class="form-group">
                        <label for="timeEnd">Thời gian kết thúc:</label>
                        <input type="datetime-local" class="form-control" id="timeEnd" name="timeEnd" required>
                    </div>
                    <button type="submit" class="btn btn-success">Xác nhận</button>
                </form>
            </div>
        </div>
    </div>




</div>

<?php require_once "footer.php"; ?>

<script>
    // Hàm để mở modal và hiển thị dịch vụ cho sân
    function choosesan(pitchId) {
        // Đặt giá trị pitchId trong input ẩn
        document.getElementById('pitchId').value = pitchId;

        // Mở modal
        document.getElementById('bookPicthModal').style.display = 'flex'; // Hiển thị modal

        // Gửi yêu cầu AJAX để lấy danh sách dịch vụ cho sân đã chọn
        $.ajax({
            url: 'get_services.php',
            method: 'GET',
            data: {
                pitchId: pitchId
            },
            success: function(response) {
                // Đổ dữ liệu dịch vụ vào trong modal
                $('#serviceList').html(response);
            }
        });
    }

    // Khi người dùng nhấn nút đóng modal
    document.getElementById('closeModalBtn').onclick = function() {
        document.getElementById('bookPicthModal').style.display = 'none'; // Đóng modal
    };

    // Đóng modal nếu người dùng nhấn ra ngoài modal
    window.onclick = function(event) {
        if (event.target == document.getElementById('bookPicthModal')) {
            document.getElementById('bookPicthModal').style.display = 'none';
        }
    };

    // Xử lý khi gửi form đặt sân
    $(document).ready(function() {
        $('#bookingForm').submit(function(e) {
            e.preventDefault();

            // Lấy dữ liệu từ form
            var formData = $(this).serialize();

            // Gửi dữ liệu để lưu thông tin đặt sân
            $.ajax({
                url: 'book_pitch.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response === 'success') {
                        alert('Đặt sân thành công!');
                        document.getElementById('bookPicthModal').style.display = 'none'; // Đóng modal sau khi đặt sân thành công
                    } else {
                        alert(response); // Hiển thị thông báo lỗi nếu có
                    }
                }
            });
        });
    });
</script>