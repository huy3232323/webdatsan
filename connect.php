<?php
try {
    $conn = new PDO('mysql:host=localhost:3306;dbname=qlsanbanh', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

define('BASE_ADMIN_URL', '/webdatsan/admin/');
define('BASE_URL', '/webdatsan/');