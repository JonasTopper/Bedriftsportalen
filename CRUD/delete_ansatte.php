<?php
include 'connect.php';

if (isset($_POST['confirm_delete'])) {
    $ansatte_id = $_POST['ansatte_id'];

    $sql_delete_ansatte = "DELETE FROM ansatte_tb WHERE ansatte_id = $ansatte_id";

    $result_delete_ansatte = mysqli_query($conn, $sql_delete_ansatte);

    if (!$result_delete_ansatte) {
        die("Delete query failed: " . mysqli_error($conn));
    } else {
        // Redirect to read.php after successful deletion
        header("Location: ../");
        exit();
    }
}