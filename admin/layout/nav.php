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
    
</nav>