<!DOCTYPE html>
<html lang="en">
<head>
  <title>Đặt sân nhanh</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/ico" href="/icon/favicon.ico"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="css/style2.css">
  <link rel="stylesheet" href="css/datepicker.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <link href="/css/mdtimepicker.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
  <!-- jQuery Custom Scroller CDN -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>

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

    .dropdown>.dropdown-toggle:active {
      pointer-events: none;
    }
    .dropdown-item-menu{
      font-size: 14px;
    }
    .dropdown-item-menu:hover{
      font-size: 14px;
      background: grey;
    }
    .header-web{
      width: 100%;
    }
  </style>
</head>
<body>
<div class="wrapper">
    <!-- Page Content -->
    <div class="header-web">
          <div class="form-inline">
          <button type="button" id="sidebarCollapse" class="btn btn-info">
            <i class="fas fa-align-left"></i>
            <span>Toggle Sidebar</span>
          </button>
          <a href="#" style="text-decoration: none;float: left;color: white;font-size: 20px;">Trang chủ</a>

          <div class="form-inline" style="float: right;color: white;display: flex; letter-spacing: 2px;margin-right: 50px;">
            Welcome 
            <div class="dropdown d-inline" style="margin: 0 5px;">
              <a href="#" style="text-decoration: none;color: blue;" id="dropdownMenuButton">Nguyen Van A</a>
              <div class="dropdown-menu" style="background-color: #2b90e2;color: cornsilk;" aria-labelledby="dropdownMenuButton">
                <p class="dropdown-item-menu" style="color: white;"><a class="dropdown-item" href="#">Trang quản trị</a></p>
                <p class="dropdown-item-menu" style="color: white;"><a class="dropdown-item" href="#">Quản lý tài khoản</a></p>
                <p class="dropdown-item-menu" style="color: white;"><a class="dropdown-item" href="#">Thay đổi mật khẩu</a></p>
                <p class="dropdown-item-menu" style="color: white;"><a class="dropdown-item" href="#">Điểm thưởng<span style="color: red;">100</span></a></p>
                <p class="dropdown-item-menu" style="color: white;"><a class="dropdown-item" href="#">Đăng xuất</a></p>
              </div>
            </div>
            <a class="d-inline" href="#" style="text-decoration: none;color: green;">Logout</a>
          </div>
        </div>
    </div>

    <div id="content col-lg-13" style="margin: auto;width: 30%;margin-top: 100px;">
      <h1>Quản lý tài khoản</h1>
      <form id="formUpdateInfo" action="#" method="POST">
        <div class="form-group">
          <label>Họ và tên</label>
          <input type="text" class="form-control input-sm" name="tenkhachhang" value="Nguyen Van A">
          <input type="hidden" name="idkhachhang" value="12345">
        </div>
        <div class="form-group">
          <label>Số điện thoại</label>
          <input type="text" class="form-control input-sm" name="sodt" value="0987654321">
        </div>
        <div class="form-group">
          <label>Địa chỉ</label>
          <input type="text" class="form-control input-sm" name="diachi" value="123 ABC Street">
        </div>
        <div class="form-group">
          <label>Giới tính</label>
          <input type="text" class="form-control input-sm" name="gioitinh" value="Nam">
        </div>
        <div class="form-group">
          <label>Ngày tháng năm sinh</label>
          <input type="text" class="form-control input-sm" name="ngaysinh" value="01/01/1990">
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="Email" class="form-control input-sm" name="email" value="nguyenvana@example.com">
        </div>
        <div class="form-group">
          <label>Điểm thưởng</label>
          <input type="number" class="form-control input-sm" value="100" disabled="true">
        </div>
        <p style="text-align:center;">
          <input type="button" value="Cập nhật thông tin" class="btn btn-warning" data-toggle="modal" data-target="#confirm" id="btnUpdateInfo">
        </p>
      </form>
    </div>
</div>

<div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="confirm" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="background-color: #f7f7f7;">
      <div class="modal-header" style="text-align: center;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h3 class="modal-title" style="font-size: -webkit-xxx-large;font-family: -webkit-body;">Xác nhận</h3>
      </div>
      <form action="#">
      <div class="modal-body" style="text-align: center;">
        <p>Bạn có muốn cập nhật thông tin tài khoản không?</p>
      </div>
      <div class="modal-footer" style="text-align: center;">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="btnExcuteUpdate">Cập nhật</button>
      </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: slategrey;">
          <div class="modal-header" style="text-align: center;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="modal-title" style="font-size: -webkit-xxx-large;font-family: -webkit-body;">Đăng nhập
              </h3>
          </div>
          <form action="<?php echo base_url();?>index.php/login_controller/index" method="POST">
              <div class="modal-body" style="text-align: center;">
                  <img src="/image/ninja-simple-login.png" alt="login" style="width: 40%;margin-bottom: 20px;">
                  <div class="form-inline">
                      <label>Tài khoản:</label>
                      <input type="text" name="username" class="form-control">
                  </div>
                  <div class="form-inline" style="margin-top: 10px;">
                      <label>Mật khẩu:</label>
                      <input type="password" name="password" class="form-control" style="margin-left: 4px;">
                  </div>

              </div>
              <div class="modal-footer" style="text-align: center;"">
  <button type=" button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Đăng nhập</button>
              </div>
          </form>
      </div>
  </div>
</div>

<div class="modal fade" id="regModal" tabindex="-1" role="dialog" aria-labelledby="Register" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content" style="background-color: slategrey;">
          <div class="modal-header" style="text-align: center;">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
              <h3 class="modal-title" style="font-size: -webkit-xxx-large;font-family: -webkit-body;">Đăng nhập
              </h3>
          </div>
          <form action="<?php echo base_url();?>index.php/login_controller/index" method="POST">
              <div class="modal-body" style="text-align: center;">
                  <img src="/image/ninja-simple-login.png" alt="login" style="width: 40%;margin-bottom: 20px;">
                  <div class="form-inline">
                      <label>Tài khoản:</label>
                      <input type="text" name="username" class="form-control">
                  </div>
                  <div class="form-inline" style="margin-top: 10px;">
                      <label>Mật khẩu:</label>
                      <input type="password" name="password" class="form-control" style="margin-left: 4px;">
                  </div>

                  <div class="form-inline" style="margin-top: 10px;">
                      <label>Nhập lại Mật khẩu:</label>
                      <input type="password" name="password" class="form-control" style="margin-left: 4px;">
                  </div>

              </div>
              <div class="modal-footer" style="text-align: center;"">
  <button type=" button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary">Đăng nhập</button>
              </div>
          </form>
      </div>
  </div>
</div>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    $('#btnExcuteUpdate').on('click', function(){
      $('#formUpdateInfo').submit();
    });
  });
</script>

</body>
</html>
