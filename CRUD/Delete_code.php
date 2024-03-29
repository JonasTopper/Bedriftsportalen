<?php
include 'connect.php';

if (isset($_POST['confirm_delete'])) {
    $id = $_POST['bedrift_id'];

    $sql_delete = "DELETE FROM bedrifter_tb WHERE bedrift_id = $id";

    $result_delete = mysqli_query($conn, $sql_delete);

    if (!$result_delete) {
        die("Delete query failed: " . mysqli_error($conn));
    } else {
        // Redirect to read.php after successful deletion
        header("Location: ../");
        exit();
    }
}