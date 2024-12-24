<?php
require_once "../connect.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Đặt sân nhanh</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/ico" href="../icon/favicon.ico" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/style2.css">
  <link rel="stylesheet" href="../css/datepicker.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <link href="../css/mdtimepicker.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
  <style type="text/css">
    .wrapper {
      display: flex;
      width: 100%;
    }

    #sidebar {
      width: 250px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100vh;
      z-index: 999;
      background: #7386D5;
      color: #fff;
      transition: all 0.3s;
    }

    .dropdown:hover>.dropdown-menu {
      display: block;
    }

    .dropdown-item-menu {
      font-size: 14px;
    }

    .dropdown-item-menu:hover {
      font-size: 14px;
      background: grey;
    }
  </style>
</head>

<body>

  <div class="wrapper">
    <?php
    session_start(); // Bắt đầu session
    require_once "../connect.php";
    ?>
    <!-- Sidebar -->
    <div id="sidebar">
      <h3>Sidebar Menu</h3>
      <nav id="sidebar">
        <div class="sidebar-header">
          <h3>HBP FOOTBALL</h3>
        </div>

        <ul class="list-unstyled components">
        <li>
            <a href="<?php echo BASE_ADMIN_URL; ?>index.php">Trang chủ</a>
        </li>
          <li>
            <a href="<?php echo BASE_ADMIN_URL; ?>san/list.php">Quản lý sân</a>
          </li>
          <li>
            <a href="<?php echo BASE_ADMIN_URL; ?>user/list.php">Quản lý người dùng</a>
          </li>
          <li>
            <a href="<?php echo BASE_ADMIN_URL; ?>order/list.php">Quản lý đơn đặt</a>
          </li>
          <!-- <?php if (isset($_SESSION['username'])): ?>
            <li>
              <a href="#">Đăng xuất</a>
            </li>
          <?php endif; ?> -->

          <li>
            <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Liên hệ</a>
            <ul class="collapse list-unstyled" id="pageSubmenu">
              <li>
                <a href="#">Số điện thoại: 035.68.68.468</a>
              </li>
              <li>
                <a href="#">Facebook</a>
              </li>
              <li>
                <a href="#">Gmail</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="#">Hỗ trợ</a>
          </li>
          <li>
            <a href="#">Feedback</a>
          </li>
        </ul>
      </nav>
    </div>

    <!-- Page Content -->
    <div class="header-web">
      <div class="form-inline">
        <button type="button" id="sidebarCollapse" class="btn btn-info">
          <i class="fas fa-align-left"></i>
          <span>Toggle Sidebar</span>
        </button>

        <?php if (isset($_SESSION['username'])): ?>
          <span class="mr-3">Chào, <?= htmlspecialchars($_SESSION['username']) ?>!</span>
          <a href="../logout.php" type="button" class="btn btn-danger">Đăng xuất</a>
        <?php else: ?>
          <a href="../register.php" type="button" class="btn btn-warning btn-register">Đăng ký</a>
          <a href="../login.php" type="button" class="btn btn-success btn-login" style="margin-right: 10px;">Đăng nhập</a>
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



    <div id="content">
      <h1>Trang quản lý</h1>
      <div class="row">
        <p><a type="button" name="" id="btnAddPitch" class="btn btn-success" value="" href="add.html"> Thêm sân </a></p>
        <table class="table">
          <thead>
            <tr>
              <th>Mã sân</th>
              <th>Tên sân</th>
              <th>Loại sân</th>
              <th>Đơn giá</th>
              <th>Ngày tạo</th>
              <th>Xóa</th>
            </tr>
          </thead>
          <tbody id="">
            <!-- Fake data for pitch management -->
            <tr class="sandisplay">
              <td>01</td>
              <td>Sân A</td>
              <td>Sân 5</td>
              <td>200,000 VND</td>
              <td>2024-10-10</td>
              <td><input type="button" name="" class="btn btn-warning" value="Sửa"> <input type="button" name="" class="btn btn-danger" value="Xoá"></td>
            </tr>
            <tr class="sandisplay">
              <td>02</td>
              <td>Sân B</td>
              <td>Sân 7</td>
              <td>300,000 VND</td>
              <td>2024-10-12</td>
              <td><input type="button" name="" class="btn btn-warning" value="Sửa"> <input type="button" name="" class="btn btn-danger" value="Xoá"></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>


  <style>
    /* Content Section */
#content {
    margin-left: 250px; /* Khoảng cách với sidebar */
    margin-top: 80px; /* Khoảng cách với header */
    padding: 30px;
    background: #f8f9fa; /* Màu nền sáng */
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Hiệu ứng đổ bóng */
    overflow-x: auto; /* Thêm thanh cuộn ngang nếu cần */
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
#btnAddPitch {
    font-size: 14px;
    font-weight: bold;
    text-transform: uppercase;
    padding: 10px 15px;
    border-radius: 5px;
    color: #fff;
    text-decoration: none;
    transition: all 0.3s ease-in-out;
}

#btnAddPitch:hover {
    background-color: #45a049; /* Màu xanh đậm khi hover */
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

/* Nút sửa/xóa */
.btn-warning, .btn-danger {
    font-size: 12px;
    padding: 5px 10px;
    border-radius: 5px;
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    border: none;
    transition: all 0.3s ease-in-out;
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
    }
}

  </style>

  <style type="text/css">
/* Toàn bộ sidebar */
#sidebar {
  width: 260px;
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  z-index: 999;
  background: #1e1e2f; /* Tông màu tối */
  color: #fff;

  transition: all 0.3s ease-in-out;
  overflow-y: auto; /* Cho phép cuộn */
}

/* Header của sidebar */
#sidebar .sidebar-header {
  padding: 20px;
  background: linear-gradient(135deg, #6a11cb, #2575fc); /* Gradient tím xanh */
  text-align: center;
  font-size: 20px;
  font-weight: bold;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
}

/* Danh sách menu */
#sidebar ul.components {
  padding: 0;
  margin: 0;
  list-style: none;
}

#sidebar ul.components li {
  margin: 0;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1); /* Đường kẻ ngăn cách */
}

#sidebar ul.components li a {
  display: flex;
  align-items: center;
  padding: 15px 20px;
  color: white;
  text-decoration: none;
  font-size: 16px;
  transition: all 0.3s ease-in-out;
}

#sidebar ul.components li a i {
  margin-right: 15px;
  font-size: 18px;
  color: #a0a0a0; /* Màu icon */
  transition: color 0.3s ease-in-out;
}

/* Hiệu ứng hover */
#sidebar ul.components li a:hover {
  background: rgba(255, 255, 255, 0.1);
  color: #00d4ff; /* Màu xanh neon khi hover */
}

#sidebar ul.components li a:hover i {
  color: #00d4ff; /* Icon đổi màu khi hover */
}

/* Mục active */
#sidebar ul.components li.active > a {
  background: #2575fc; /* Màu xanh nổi bật */
  font-weight: bold;
  color: #fff;
}

/* Dropdown menu */
#sidebar ul.components li a.dropdown-toggle::after {
  content: "\25B6"; /* Biểu tượng mũi tên ngang */
  margin-left: auto;
  transform: rotate(0deg);
  transition: transform 0.3s ease-in-out;
}

#sidebar ul.components li.open > a.dropdown-toggle::after {
  transform: rotate(90deg); /* Xoay mũi tên khi mở menu con */
}

#sidebar ul.components ul {
  list-style: none;
  padding-left: 20px; /* Thụt lề submenu */
  display: none;
}

#sidebar ul.components li.open > ul {
  display: block; /* Hiển thị submenu khi mở */
}

#sidebar ul.components ul li a {
  background: rgba(255, 255, 255, 0.05); /* Màu nền submenu */
  color: #ccc;
  padding: 10px 20px;
  font-size: 14px;
  transition: all 0.3s ease-in-out;
}

#sidebar ul.components ul li a:hover {
  background: rgba(255, 255, 255, 0.2); /* Hiệu ứng hover submenu */
  color: white;
}
</style>


  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


</body>

</html>