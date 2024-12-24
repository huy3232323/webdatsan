<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đặt sân nhanh</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/ico" href="/icon/favicon.ico"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/style2.css">
    <link rel="stylesheet" href="css/datepicker.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <link href="/css/mdtimepicker.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
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
        .dropdown-item-menu {
            font-size: 14px;
        }
        .dropdown-item-menu:hover {
            background: grey;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <div id="sidebar">
        <!-- Sidebar content here -->
        <h2>Sidebar Menu</h2>
        <ul>
            <li><a href="#">Trang chủ</a></li>
            <li><a href="#">Quản lý sân</a></li>
            <li><a href="#">Thống kê</a></li>
            <li><a href="#">Cài đặt</a></li>
        </ul>
    </div>

    <!-- Page Content -->
    <div id="content" style="margin-left: 250px;">
        <div class="header-web">
            <div class="form-inline">
                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>
                <div style="float: right; color: white; display: flex; letter-spacing: 2px; margin-right: 50px;">
                    <span>Welcome User</span>
                    <div class="dropdown d-inline" style="margin: 0 5px;">
                        <a href="#" style="text-decoration: none; color: blue;" id="dropdownMenuButton">User Name</a>
                        <div class="dropdown-menu" style="background-color: #2b90e2; color: cornsilk;">
                            <p class="dropdown-item-menu" style="color: white;"><a class="dropdown-item" href="#">Quản lý tài khoản</a></p>
                            <p class="dropdown-item-menu" style="color: white;"><a class="dropdown-item" href="#">Thay đổi mật khẩu</a></p>
                            <p class="dropdown-item-menu" style="color: white;"><a class="dropdown-item" href="#">Đăng xuất</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1>Trang quản lý hóa đơn</h1>
        <div class="row">
            <p id="error-message" style="color: red;"></p>
            <p><input type="button" name="" id="btnAddPitch" class="btn btn-success" value="Thêm sân"></p>
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
                <tbody id="pitchTable">
                <tr class="sandisplay">
                    <td>1</td>
                    <td>Sân A</td>
                    <td>Sân 5</td>
                    <td>200,000 VNĐ</td>
                    <td>2024-10-01</td>
                    <td><input type="button" name="" class="btn btn-danger" value="Xóa"></td>
                </tr>
                <tr class="sandisplay">
                    <td>2</td>
                    <td>Sân B</td>
                    <td>Sân 7</td>
                    <td>300,000 VNĐ</td>
                    <td>2024-10-05</td>
                    <td><input type="button" name="" class="btn btn-danger" value="Xóa"></td>
                </tr>
                <tr class="sandisplay">
                    <td>3</td>
                    <td>Sân C</td>
                    <td>Sân 11</td>
                    <td>500,000 VNĐ</td>
                    <td>2024-10-10</td>
                    <td><input type="button" name="" class="btn btn-danger" value="Xóa"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="mdAddPitch" tabindex="-1" role="dialog" aria-labelledby="mdAddPitch" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #f7f7f7;">
            <div class="modal-header" style="text-align: center;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title">Thêm sân</h3>
            </div>
            <div class="modal-body" style="text-align: center;">
                <div class="form-group">
                    <label for="newPitchName">Tên sân:</label>
                    <input type="text" class="form-control" id="newPitchName" placeholder="Nhập tên sân">
                </div>
                <div class="form-group">
                    <label for="newUnitPrice">Giá sân:</label>
                    <input type="text" class="form-control" id="newUnitPrice" placeholder="Nhập giá sân">
                </div>
                <div class="form-group">
                    <label for="newPitchType">Loại sân:</label>
                    <select class="form-control" id="newPitchType">
                        <option value="1">Sân 5</option>
                        <option value="2">Sân 7</option>
                        <option value="3">Sân 11</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer" style="text-align: center;">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="btnAddPitchConfirm">Thêm</button>
            </div>
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
        $('#btnAddPitch').on('click', function () {
            $('#mdAddPitch').modal('show');
        });

        $('#btnAddPitchConfirm').on('click', function () {
            const pitchName = $('#newPitchName').val();
            const unitPrice = $('#newUnitPrice').val();
            const pitchType = $('#newPitchType').val();

            // Validate inputs
            if (!pitchName || !unitPrice || !pitchType) {
                toastr.error('Vui lòng điền đầy đủ thông tin!');
                return;
            }

            // Add a new row to the table (mock action)
            $('#pitchTable').append(`
                <tr class="sandisplay">
                    <td>4</td>
                    <td>${pitchName}</td>
                    <td>${pitchType}</td>
                    <td>${unitPrice} VNĐ</td>
                    <td>${new Date().toLocaleDateString()}</td>
                    <td><input type="button" name="" class="btn btn-danger" value="Xóa"></td>
                </tr>
            `);

            $('#mdAddPitch').modal('hide');
            toastr.success('Thêm sân thành công!');
        });
    });
</script>
</body>
</html>
