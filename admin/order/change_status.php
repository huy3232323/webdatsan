<?php
require_once "../../connect.php";

if(isset($_POST['id']) && isset($_POST['status'])) {
    $id = $_POST['id'];
    $status = $_POST['status'];

    try {
        // Update the status of the invoice in the database
        $sql = "UPDATE tbl_hoadon SET status = :status WHERE idhoadon = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);

        // Execute the query
        if($stmt->execute()) {
            echo 'success'; // Respond with success message
        } else {
            echo 'error'; // Respond with error message
        }
    } catch (PDOException $e) {
        echo 'error'; // Respond with error message
    }
}
?>
